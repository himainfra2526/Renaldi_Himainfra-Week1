import { useEffect, useState } from 'react'

function App() {
  const [data, setData] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)
  const [search, setSearch] = useState('')
  const [sortAsc, setSortAsc] = useState(true)
  const [page, setPage] = useState(1)
  const [lastPage, setLastPage] = useState(1)

  useEffect(() => {
  setLoading(true)

  fetch(`http://127.0.0.1:8000/api/soal?page=${page}`)
      .then(res => res.json())
      .then(result => {
        setData(result.data)
        setLastPage(result.last_page)
        setLoading(false)
      })
      .catch(err => {
        setError("Gagal ambil data")
        setLoading(false)
      })
  }, [page])

  if (loading) return <p>Loading...</p>
  if (error) return <p>{error}</p>

  return (
  <div className="container mt-5">
    <h1 className="text-center mb-4 text-dark">Data Soal (React)</h1>
    <input
      type="text"
      placeholder="Cari matkul / tipe..."
      className="form-control mb-3"
      value={search}
      onChange={(e) => setSearch(e.target.value)}
    />

    <button
      className="btn btn-primary mb-3"
      onClick={() => setSortAsc(!sortAsc)}
    >
      Sort Tahun ({sortAsc ? 'Asc' : 'Desc'})
    </button>

    <table className="table table-bordered table-striped bg-white">
      <thead className="table-dark">
        <tr>
          <th>No</th>
          <th>Matkul</th>
          <th>Tahun</th>
          <th>Tipe</th>
        </tr>
      </thead>
      <tbody>
        {data
        .filter(item =>
          item.matkul.toLowerCase().includes(search.toLowerCase()) ||
          item.tipe.toLowerCase().includes(search.toLowerCase())
        )
        .sort((a, b) => sortAsc ? a.tahun - b.tahun : b.tahun - a.tahun)
        .map((item, index) => (
          <tr key={item.id}>
            <td>{index + 1}</td>
            <td>{item.matkul}</td>
            <td>{item.tahun}</td>
            <td>{item.tipe}</td>
          </tr>
        ))}
      </tbody>
    </table>

    <div className="d-flex justify-content-between mt-3">
      <button
        className="btn btn-secondary"
        disabled={page === 1}
        onClick={() => setPage(page - 1)}
      >
        Prev
      </button>

      <span>Page {page} / {lastPage}</span>

      <button
        className="btn btn-secondary"
        disabled={page === lastPage}
        onClick={() => setPage(page + 1)}
      >
        Next
      </button>
    </div>
  </div>
  )
}

export default App