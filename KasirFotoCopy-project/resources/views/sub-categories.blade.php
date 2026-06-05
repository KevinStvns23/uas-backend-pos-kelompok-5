<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Sub-Kategori</title>
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
        <a href="/sub-categories" style="font-weight: bold; background: #e0e0e0;">Sub-Kategori</a>
        <a href="/discounts">Diskon</a>
    </div>

    <div class="content">
        <h1>Manajemen Sub-Kategori</h1>
        
        <h2>Form Sub-Kategori</h2>
        <form id="subCategoryForm">
            <input type="hidden" id="subCategoryId">
            
            Kategori Induk:
            <br>
            <select id="category_id" required>
                <option value="">-- Pilih Kategori --</option>
            </select>
            <br>
            <br>

            Nama Sub-Kategori:
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

        <h2>Daftar Sub-Kategori</h2>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Kategori Induk</th>
                    <th>Nama Sub-Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="subCategoryTableBody">
            </tbody>
        </table>
    </div>

    <script>
        const tableBody = document.getElementById('subCategoryTableBody');
        const form = document.getElementById('subCategoryForm');
        let categoriesData = []; // Untuk menyimpan data kategori induk sementara

        async function loadCategoriesForSelect() {
            try {
                const response = await fetch('/api/categories');
                const result = await response.json();
                categoriesData = result.data;
                
                const select = document.getElementById('category_id');
                select.innerHTML = '<option value="">-- Pilih Kategori --</option>';
                
                categoriesData.forEach(cat => {
                    select.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                });
            } catch (error) {
                console.error(error);
            }
        }

        // 2. Ambil data Sub-Kategori untuk Tabel
        async function loadSubCategories() {
            try {
                const response = await fetch('/api/sub-categories');
                const result = await response.json();
                
                tableBody.innerHTML = '';
                
                result.data.forEach(sub => {
                    const desc = sub.description ? sub.description : '';
                    
                    const parentCat = categoriesData.find(c => c.id == sub.category_id);
                    const parentName = parentCat ? parentCat.name : `(ID: ${sub.category_id})`;

                    const row = `
                        <tr>
                            <td>${parentName}</td>
                            <td>${sub.name}</td>
                            <td>${desc || '-'}</td>
                            <td>
                                <button onclick="editSubCategory(${sub.id}, ${sub.category_id}, '${sub.name}', '${desc}')">Edit</button>
                                <button onclick="deleteSubCategory(${sub.id})">Hapus</button>
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
            
            const id = document.getElementById('subCategoryId').value;
            const category_id = document.getElementById('category_id').value;
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;

            const method = id ? 'PUT' : 'POST';
            const url = id ? `/api/sub-categories/${id}` : '/api/sub-categories';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ category_id, name, description })
                });

                if (response.ok) {
                    form.reset();
                    document.getElementById('subCategoryId').value = '';
                    loadSubCategories();
                } else {
                    const errorData = await response.json();
                    alert(errorData.message || 'Gagal menyimpan data');
                }
            } catch (error) {
                console.error(error);
            }
        });

        function editSubCategory(id, category_id, name, description) {
            document.getElementById('subCategoryId').value = id;
            document.getElementById('category_id').value = category_id;
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            window.scrollTo(0, 0);
        }

        async function deleteSubCategory(id) {
            if (!confirm('Hapus sub-kategori ini?')) return;

            try {
                const response = await fetch(`/api/sub-categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    loadSubCategories();
                }
            } catch (error) {
                console.error(error);
            }
        }

        window.onload = async () => {
            await loadCategoriesForSelect();
            loadSubCategories();
        };
    </script>
</body>
</html>