<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kategori</title>
    <style>
        body { margin: 0; display: flex; font-family: Arial, sans-serif; }
        .sidebar { width: 200px; background: #f4f4f4; padding: 15px; height: 100vh; border-right: 1px solid #ccc; }
        .sidebar a { display: block; padding: 10px; margin-bottom: 5px; text-decoration: none; color: black; border: 1px solid #ccc; background: white; }
        .content { padding: 20px; flex: 1; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu Kasir</h3>
        <a href="/">Kategori</a>
        <a href="/sub-categories">Sub-Kategori</a>
        <a href="/discounts">Diskon</a>
    </div>

    <div class="content">
        <h1>Manajemen Kategori</h1>
        
        <h2>Form Kategori</h2>
        <form id="categoryForm">
            <input type="hidden" id="categoryId">
            
            Nama Kategori:
            <br>
            <input type="text" id="name" required>
            <br>
            <br>
            
            Deskripsi:
            <br>
            <textarea id="description" rows="3"></textarea>
            <br>
            <br>
            
            <button type="submit">Simpan</button>
        </form>

        <hr>

        <h2>Daftar Kategori</h2>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="categoryTableBody">
            </tbody>
        </table>
    </div>

    <script>
        const tableBody = document.getElementById('categoryTableBody');
        const form = document.getElementById('categoryForm');

        async function loadCategories() {
            try {
                const response = await fetch('/api/categories');
                const result = await response.json();
                
                tableBody.innerHTML = '';
                
                result.data.forEach(category => {
                    const desc = category.description ? category.description : '';
                    const row = `
                        <tr>
                            <td>${category.name}</td>
                            <td>${desc || '-'}</td>
                            <td>
                                <button onclick="editCategory(${category.id}, '${category.name}', '${desc}')">Edit</button>
                                <button onclick="deleteCategory(${category.id})">Hapus</button>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            } catch (error) {
                console.error(error);
            }
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const id = document.getElementById('categoryId').value;
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;

            const method = id ? 'PUT' : 'POST';
            const url = id ? `/api/categories/${id}` : '/api/categories';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name, description })
                });

                if (response.ok) {
                    form.reset();
                    document.getElementById('categoryId').value = '';
                    loadCategories();
                } else {
                    const errorData = await response.json();
                    alert(errorData.message || 'Gagal menyimpan data');
                }
            } catch (error) {
                console.error(error);
            }
        });

        function editCategory(id, name, description) {
            document.getElementById('categoryId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
        }

        async function deleteCategory(id) {
            if (!confirm('Hapus kategori ini?')) return;

            try {
                const response = await fetch(`/api/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    loadCategories();
                }
            } catch (error) {
                console.error(error);
            }
        }

        window.onload = loadCategories;
    </script>
</body>
</html>