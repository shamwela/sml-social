<div class='flex flex-col gap-y-1'>
  <label for={{ $name }}>
    {{ ucfirst($name) }}
  </label>
  
  @if ($type === 'textarea')
    <textarea name={{ $name }} id={{ $name }} required>{{ old($name) }}</textarea>
  @else
    <input name={{ $name }} id={{ $name }} value='{{ old($name) }}' type={{ $type }} required>
  @endif

  @error($name)
    <x-error :$message />
  @enderror
</div>
