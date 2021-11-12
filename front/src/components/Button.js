const Button = ({ color, text,icon, onClick }) => {
  return (
    <button
      onClick={onClick}
      style={{ backgroundColor: color }}
      className='btn'
    >
      <span style={{marginRight: '10px'}}>{icon}</span>
      {text}
    </button>
  )
}

export default Button