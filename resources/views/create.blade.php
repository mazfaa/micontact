<x-master-admin>
  <form action="{{ route('contact.store') }}" method="post">
    @csrf
     <div class="mb-3">
       <label for="exampleInputPassword1" class="form-label">Name</label>
       <input name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="exampleInputPassword1">
       @error('name')
           <span class="invalid-feedback">{{ $message }}</span>
       @enderror
     </div>
     <div class="mb-3">
       <label for="exampleInputEmail1" class="form-label">Email Address</label>
       <input name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
       @error('email')
           <span class="invalid-feedback">{{ $message }}</span>
       @enderror
     </div>
     <div class="mb-3">
       <label for="exampleInputEmail1" class="form-label">Phone</label>
       <input name="phone" type="text" value="{{ old('phone')}}" class="form-control @error('phone') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
       @error('phone')
           <span class="invalid-feedback">{{ $message }}</span>
       @enderror
     </div>
     <button type="submit" class="btn btn-primary mt-2"><i class="bi bi-pencil-square"></i> Create</button>
   </form>
</x-master-admin>