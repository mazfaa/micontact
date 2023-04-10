<x-master-front>
  <x-form>
    <form action="{{ route('login') }}" method="post">
      @csrf
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" value="{{ old('name') }}" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-dark">Login</button>
        <a href="{{ route('register') }}" class="text-secondary">Create Account</a>
      </div>
    </form>
  </x-form>
</x-master-front>