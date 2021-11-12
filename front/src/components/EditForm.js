import { useState, useEffect } from 'react'
import { FaTimes } from 'react-icons/fa'

const EditForm = (props) => {
  console.log(props.data)
  const [name, setName] = useState('');
  const [date, setDate] = useState('');

  useEffect(() => {
    setName(props.data.name)
    setDate(props.data.date.date)
  }, [])
  // Fetch Tasks

  const onSubmit = (e) => {
    e.preventDefault()

    props.onClose()
    props.submitEditForm({id: props.data.id, name: name, date:date})
    setName('')
    setDate('')

  }
  const onCancel = () =>{
    props.onClose()
  }
  return (
    <div style={{ backgroundColor:'white', position: 'absolute', width:'100%', height:'100vh', padding:'20px'}}>
      <FaTimes
      style={{ color: 'red', cursor: 'pointer', fontSize:'20pt'}}
      onClick={(e) => onCancel()}/>
      <form className='add-form' onSubmit={onSubmit}>
        <div >
          <label>Launch Name</label>
          <input
            type='text'
            value={name}
            onChange={(e) => setName(e.target.value)}
          />
        </div>
        <div className='form-group'>
          <label>Date</label>
          <input
            type='text'
            value={date}
            onChange={(e) => setDate(e.target.value)}
          />
        </div>       
        <input type='submit' value='Change Launch' onClick={onSubmit}  />
      </form>

    </div>
  )
}

export default EditForm