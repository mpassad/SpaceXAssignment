import {
  useState,
  useEffect
} from 'react'
import {
  BrowserRouter as Router,
  Route
} from 'react-router-dom'

import Header from './components/Header'
import Footer from './components/Footer'
import Launches from './components/Launches'
import FilterLaunchesForm from './components/FilterLaunchesForm'
import EditForm from './components/EditForm'
import About from './components/About'

const App = () => {
    const [showFilters, setShowFilter] = useState(true)
    const [showEditForm, setShowEditForm] = useState(false)
    const [showTasks, setShowTasks] = useState(true)

    const [editData, setEditData] = useState({})
    const [filters, setFilters] = useState({from: '', to: '', sort: 'ASC', selectedRocket: '0'});
    const [rockets, setRockets] = useState([]);
    const [launches, setLaunches] = useState([]);


    useEffect(() => {
      const getRockets = async () => {
        const rockets = await fetchRockets();
        setRockets(rockets);
      }
      const getLaunches = async () => {
        const launches = await fetchLaunches();
        setLaunches(launches);
      }
      getRockets();
      getLaunches();
    }, [])

    // Fetch Launches
    const fetchRockets = async () => {
      const res = await fetch('http://127.0.0.1:8000/rockets')
      const data = await res.json()
      console.log(data);
      return data
    }
    const fetchLaunches = async () => {
      const res = await fetch('http://127.0.0.1:8000/launches')
      const data = await res.json();
      console.log(data);
      return data
    }

    // Add Task
    const submitEditForm = async (launch)=>{
      console.log('submit edit launch form')
      const res = await fetch('http://localhost:8000/launch/edit?' + new URLSearchParams({
        id: launch.id,
        name: launch.name,
        date: launch.date
      }));
      console.log(await res.url)
      const data = await res.json()
      console.log('data')
      console.log(data)
      console.log('data')
      return data
    }
    const showData = async (launch) => {      
      var new_data_to_submit = await submitEditForm(launch)
      console.log(new_data_to_submit);
      var new_launches = await fetchFilteredLaunches(filters)
      setLaunches([])
      setLaunches(new_launches)
    }
    const fetchFilteredLaunches = async (launch) => {
      const res = await fetch('http://127.0.0.1:8000/launches?' + new URLSearchParams({
        from : launch.from,
        to: launch.to,
        sort: launch.sort,
        rocket: launch.selectedRocket          
    }));
      const data = await res.json()
      console.log(data);
      return [...data]
    }

    const filterLaunches = async (launch) => {
      setFilters(launch)
      
      var new_launches = await fetchFilteredLaunches(launch)
      setLaunches(new_launches)
    }

    const onEdit = (launch) =>{
      setShowEditForm(true)
      setShowTasks(false)
      setEditData(launch)
    }

    const onClose = () =>{
      setShowEditForm(false)
      setShowTasks(true)
    }

  
    return ( 
    <Router >
      <div className = 'container' >
      {showEditForm && < EditForm data={editData} onClose={onClose} submitEditForm={showData} initial={filters}/>}
      <Header onAdd = {
        () => setShowFilter(!showFilters)
      }
      showAdd = {
        showFilters
      }/> 
      <Route path = '/' 
      exact render = {
        (props) => ( <> 
            {showFilters && < FilterLaunchesForm onFilter ={filterLaunches} initial={filters}/>} 
            
            {
              rockets.length > 0 ? ( showTasks && <
                Launches launches = {
                  launches
                }
                onEdit = {onEdit}
                onClose = {onClose}
                />
              ) : (
                'No Launches To Show'
              )
            } <
            />
          )
        }
        /> <
        Route path = '/about'
        component = {
          About
        }
        /> <
        Footer / >
        </div> 
        </Router>
      )
    }

    export default App