export const Input = ({
  name,
  type = 'text',
  required = true,
}: {
  name: string
  type: string
  required?: boolean
}) => {
  // Capitalize the first letter
  const label = name.charAt(0).toUpperCase() + name.slice(1)

  return (
    <div className='flex flex-col gap-y-1'>
      <label htmlFor={name}>
        {label} {!required && '(Optional)'}
      </label>

      {type === 'textarea' ? (
        <textarea name={name} id={name} required={required}></textarea>
      ) : (
        <input name={name} id={name} type={type} required={required} />
      )}
    </div>
  )
}
