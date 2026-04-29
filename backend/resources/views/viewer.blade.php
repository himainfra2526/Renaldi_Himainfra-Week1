<!DOCTYPE html>
<html>
<head>
    <title>Viewer Soal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Viewer Soal (API)</h1>

    <input 
        type="text" 
        id="search" 
        class="form-control mb-3" 
        placeholder="Cari matkul / tipe..."
    >

    <p id="loading">Loading data...</p>
    <p id="error" style="color:red;"></p>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Tahun</th>
                <th>Tipe</th>
            </tr>
        </thead>
        <tbody id="data-soal"></tbody>
    </table>
</div>

<script>
    let semuaData = [];

    fetch('http://127.0.0.1:8000/api/soal')
        .then(res => res.json())
        .then(result => {
            let data = result.data; // karena paginate

            semuaData = data;
            tampilkanData(data);

            document.getElementById('loading').style.display = "none";
        })
        .catch(err => {
            document.getElementById('loading').style.display = "none";
            document.getElementById('error').innerText = "Gagal ambil data";
        });

    function tampilkanData(data){
        let tbody = document.getElementById('data-soal');
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            let row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.matkul}</td>
                    <td>${item.tahun}</td>
                    <td>${item.tipe}</td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    document.getElementById('search').addEventListener('input', function(){
        let keyword = this.value.toLowerCase();

        let hasil = semuaData.filter(item =>
            item.matkul.toLowerCase().includes(keyword) ||
            item.tipe.toLowerCase().includes(keyword)
        );

        tampilkanData(hasil);
    });
</script>

</body>
</html>