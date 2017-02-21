@extends('main_admin')

@section('title', '| Dashboard')

@section ('content')

<h2 class="sub-header">Visits</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Phone</th>
                  <th>Mail</th>
                  <th>Company</th>
                </tr>
              </thead>
              @foreach ($posts as $post)
              <tbody>
                
                
                  <tr>
                    <td> {{ $post->firstname }} </td>
                    <td> {{ $post->lastname }} </td>
                    <td> {{ $post->phone }} </td>
                    <td> {{ $post->email }}</td>
                    <td> {{ $post->company }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>

@endsection