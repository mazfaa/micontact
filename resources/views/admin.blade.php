<x-master-admin>
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @elseif (session('failed'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('failed') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <table class="table table-hover" id="order-table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email Address</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Settings</th>
      </tr>
    </thead>
    <tbody>
      @php
        $no = 1;
      @endphp
      @foreach ($contacts as $contact)
        <tr>
          <th scope="row">{{ $no++ }}</th>
          <td>{{ $contact->name }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->phone }}</td>
          <td>
            <form action="{{ route('contact.destroy', $contact) }}" method="post">
              @csrf
              @method('delete')
              <a href="{{ route('contact.edit', $contact) }}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
              <button type="submit" class="btn btn-sm btn-danger d-inline" onclick="return confirm('Are you sure want to delete this contact?')"><i class="bi bi-trash3"></i></button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</x-master-admin>