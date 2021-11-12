import Launch from './Launch'

const Launches = (props) => {
  return (
    <>
      {props.launches.map((launch, index) => (
        <Launch key={index} launch={launch} onEdit={props.onEdit} onClose={props.onClose} />
      ))}
    </>
  )
}

export default Launches