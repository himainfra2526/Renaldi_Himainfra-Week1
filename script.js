let semuaData = [];

function loadData(){
    const loading = document.getElementById("loading");
    loading.innerHTML = "Loading...";

    fetch("data.json")
    .then(function(res){
        return res.json();
    })
    .then(function(data){
        semuaData = data;

        loading.innerHTML = "";

        const keyword = document.getElementById("search").value.toLowerCase().trim();

        if (keyword === "") {
            tampilkan(semuaData);
        } else {
            let hasil = [];

            for (let i = 0; i < semuaData.length; i++) {
                if (semuaData[i].matkul.toLowerCase().includes(keyword)) {
                    hasil.push(semuaData[i]);
                }
            }

            tampilkan(hasil);
        }
    })
    .catch(function(error){
        loading.innerHTML = "Gagal ambil data!";
        console.log(error);
    });
}

function tampilkan(data){
    const list = document.getElementById("list");

    list.innerHTML = "";

    for (let i = 0; i < data.length; i++) {
        list.innerHTML += `
            <div class="card">
                <h4>${data[i].matkul}</h4>
                <p>Tahun: ${data[i].tahun}</p>
            </div>
        `;
    }
}

const search = document.getElementById("search");

search.addEventListener("input", function() {
  const keyword = search.value.toLowerCase().trim();

  let hasil = [];

  for (let i = 0; i < semuaData.length; i++) {
    const matkul = semuaData[i].matkul.toLowerCase();

    if (matkul === keyword) {
      hasil.push(semuaData[i]);
    }
  }

  tampilkan(hasil);
});

function tambahData() {
  const mataKuliah = document.getElementById("matkul").value;
  const tahun = document.getElementById("tahun").value;

  if (mataKuliah === "" || tahun === "") {
    alert("Isi dulu!");
    return;
  }

  const dataBaru = {
    matkul: mataKuliah,
    tahun: tahun
  };

  semuaData.push(dataBaru);

  tampilkan(semuaData);
}

window.onload = loadData;