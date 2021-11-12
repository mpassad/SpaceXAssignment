import { FaPencilAlt } from 'react-icons/fa'

const Launch = (props) => {
  var my_image;
  if (props.launch.image == null){
    my_image = 'https://upload.wikimedia.org/wikipedia/commons/f/f3/NA_cap_icon.svg'
  }else{
    my_image = props.launch.image;
  }

  return (
    <div
      className={`launch`}
    >
      <h3>
        <img src={my_image}  width='50'/> | <strong>{props.launch.name}</strong> | <strong>{props.launch.date.date}</strong>
        <button style={{border: '1px solid black', padding:'5px', borderRadius:'50%', cursor:'pointer'}} onClick={() => props.onEdit(props.launch)}>
        <FaPencilAlt
          style={{ color: 'black', cursor: 'pointer' }}
          
        />
        </button>

      </h3>
    </div>
  )
}

export default Launch