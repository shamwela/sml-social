<div class='flex flex-col gap-y-1'>
  <label for={{ $name }}>
    {{ ucfirst($name) }}
  </label>
  <input name={{ $name }} id={{ $name }} value='{{ old($name) }}' type={{ $type }} required>
  @error($name)
    <x-error :$message />
  @enderror
</div>
