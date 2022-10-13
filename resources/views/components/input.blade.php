<div class='flex flex-col gap-y-1'>
  <label for={{ $name }}>
    {{ ucfirst($name) }}
    @if (isset($optional))
      (optional)
    @endif
  </label>
  
  @if ($type === 'textarea')
    <textarea
      name={{ $name }}
      id={{ $name }}
      
      @if (!isset($optional))
        required
      @endif
    >{{ old($name) }}</textarea>
  @else
    <input
      name={{ $name }}
      id={{ $name }}
      value='{{ old($name) }}' 
      type={{ $type }}

      @if (!isset($optional))
        required
      @endif
    >
  @endif

  @error($name)
    <x-error :$message />
  @enderror
</div>
