@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Account Balances</h3>
    <button class="btn btn-primary mb-3" onclick="loadBalances()">Load Balances</button>

    <table class="table table-bordered" id="balancesTable">
        <thead>
            <tr>
                <th>Account</th>
                <th>Type</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
const API_BASE = "{{ url('/api') }}";

function loadBalances() {
  fetch(`${API_BASE}/account-balances`)
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector('#balancesTable tbody');
      tbody.innerHTML = '';
      data.forEach(item => {
        tbody.innerHTML += `
          <tr>
            <td>${item.account}</td>
            <td>${item.type}</td>
            <td>${item.balance}</td>
          </tr>`;
      });
    });
}

loadBalances();
</script>
@endsection
