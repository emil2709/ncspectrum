@extends('main_admin')

@section('title', '| Status')

@section ('content')

<script type="text/javascript">
        var people, asc1 = 1,
            asc2 = 1,
            asc3 = 1;
        window.onload = function () {
            people = document.getElementById("people");
        }

        function sort_table(tbody, col, asc) {
            var rows = tbody.rows,
                rlen = rows.length,
                arr = new Array(),
                i, j, cells, clen;
            // fill the array with values from the table
            for (i = 0; i < rlen; i++) {
                cells = rows[i].cells;
                clen = cells.length;
                arr[i] = new Array();
                for (j = 0; j < clen; j++) {
                    arr[i][j] = cells[j].innerHTML;
                }
            }
            // sort the array by the specified column number (col) and order (asc)
            arr.sort(function (a, b) {
                return (a[col] == b[col]) ? 0 : ((a[col] > b[col]) ? asc : -1 * asc);
            });
            // replace existing rows with new rows created from the sorted array
            for (i = 0; i < rlen; i++) {
                rows[i].innerHTML = "<td>" + arr[i].join("</td><td>") + "</td>";
            }
        }
    </script>

<h2 class="sub-header">Status</h2>

  <div class="table-responsive">
    <table class="table table-striped">

      <div class="input-group margin-bottom">        
        <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="guests">
      </div>

      <thead>
      	<tr>
      		<th onclick="sort_table(people, 0, asc1); asc1 *= -1; asc2 = 1; asc3 = 1;">Firstname
      		<span class="glyphicon glyphicon-arrow-down"></span></th>
            <th onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Lastname
            <span class="glyphicon glyphicon-arrow-down"></span></th>
            <th onclick="sort_table(people, 2, asc3); asc3 *= -1; asc1 = 1; asc2 = 1;">Status
            <span class="glyphicon glyphicon-arrow-down"></span></th>
            <th>Change</th>
      	</tr>
      </thead>
      <tbody id="people">
      	<tr>
      	@foreach ($users as $user)
		    <td>{{ $user->firstname }} </td>
		    <td>{{ $user->lastname }}</td>
		    <td>
		        @if ($user->status)
					{{ $user->status->status }}
		        @endif
    		</td>
    		<td>
    		 <a href="{{ action('AdminController@update/{$user->status->id}/') }}"</a>

    		</td>
		</tr>
@endforeach
      </tbody>

@endsection