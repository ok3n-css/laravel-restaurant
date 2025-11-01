<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1> Hello miss </h1>

    <p> This is a test </p>

    {{-- Flash + Errors --}}
    @if(session('ok'))
      <div class="flash-ok">{{ session('ok') }}</div>
    @endif

    @if ($errors->any())
      <div class="flash-err">
        <strong>Fix the following:</strong>
        <ul>
          @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Centered table like your reference -->
    <div class="table-wrap">
      <table class="customers-table">
          <tr>
              <th>#</th>  <!-- shows consecutive row number -->
              <th>Customer Name</th>
              <th>Customer Address</th>
              <th>Options</th>
          </tr>

          @foreach($customerData as $custData)
          <tr>
              <!-- Consecutive number for display only -->
              <td>{{ $loop->iteration }}</td>

              <!-- Actual data -->
              <td>{{ $custData->cust_name }}</td>
              <td>{{ $custData->cust_address }}</td>

              <!-- Edit/Delete -->
              <td class="actions">
                  <a href="{{ route('customers.edit', $custData->cust_id) }}" class="btn btn-edit">Edit</a>

                  <form action="{{ route('customers.destroy', $custData->cust_id) }}" method="POST" onsubmit="return confirm('Delete this customer?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Delete</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </table>
    </div>

    <!-- Customer Registration Form centered below the table -->
    <div class="customer-form">
      <h2>Customer Registration Form</h2>

      <form method="POST" action="{{ route('customers.store') }}">
          @csrf
          <label>Customer Name</label><br>
          <input type="text" id="custName" name="custName"><br>

          <label>Customer Address</label><br>
          <input type="text" id="custAdd" name="custAdd"><br><br>

          <button type="submit" class="btn">Submit</button>
      </form>
    </div>

    {{-- Edit form appears only when you click an Edit button --}}
    @isset($editingCustomer)
      <div class="customer-form">
        <h2>Customer Registration Form — Edit</h2>

        <form method="POST" action="{{ route('customers.update', $editingCustomer->cust_id) }}">
          @csrf
          @method('PUT')

          <label>Customer Name</label><br>
          <input type="text" name="custName" value="{{ old('custName', $editingCustomer->cust_name) }}"><br>

          <label>Customer Address</label><br>
          <input type="text" name="custAdd" value="{{ old('custAdd', $editingCustomer->cust_address) }}"><br><br>

          <button type="submit" class="btn">Save Changes</button>
          <a href="/home" class="btn" style="margin-left:8px;">Cancel</a>
        </form>
      </div>
    @endisset

</body>
</html>
