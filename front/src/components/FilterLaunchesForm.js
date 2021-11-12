import { useState,useEffect } from 'react'

const FilterLaunchesForm = (props) => {
  const [from, setFrom] = useState(props.initial.from)
  const [to, setTo] = useState(props.initial.to)
  const [sort, setSort] = useState(props.initial.sort);
  const [selectedRocket, setSelectedRocket] = useState(props.initial.selectedRocket);
  const [options, setOptions] = useState([]);

  useEffect(() => {
    const getRockets = async () => {
      const rockets = await fetchRockets();
      setOptions([{value: '0', label: 'All Rockets'}, ...rockets]);
    }
    getRockets();
    setSort(props.initial.sort)
    setSelectedRocket(props.initial.selectedRocket)
  }, [])

  // Fetch Tasks
  const fetchRockets = async () => {
    const res = await fetch('http://127.0.0.1:8000/rockets')
    const data = await res.json()
    console.log(data);
    return data
  }

  const onSubmit = (e) => {
    e.preventDefault()
    var filterLaunches ={ from, to, sort, selectedRocket }
    var launch = { from, to, sort, selectedRocket }
    props.onFilter(launch)
    console.log(filterLaunches)
  }
  

  const items = options.map((v_option) => <option key={v_option.value} value={v_option.value}>{v_option.label}</option>);
  return (
    <form className='add-form' onSubmit={onSubmit}>
      <div >
        <label>From Date</label>
        <input
          type='date'
          value={from}
          onChange={(e) => setFrom(e.target.value)}
        />
      </div>
      <div className='form-group'>
        <label>To Date</label>
        <input
          type='date'
          value={to}
          onChange={(e) => setTo(e.target.value)}
        />
      </div>
      <div>
        <label>Rocket</label>
        <select onChange={(e)=> setSelectedRocket(e.target.value)} value={selectedRocket}>
        {items}
        </select>
      </div>
      <div>
        <label>Sort</label>
        <select onChange={(e)=> setSort(e.target.value)} value={sort}>
        <option value="ASC">ASC</option>
        <option value="DESC">DESC</option>

        </select>
      </div>
      
      <input type='submit' value='SEARCH'  />
    </form>
  )
}

export default FilterLaunchesForm