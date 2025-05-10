@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Create Journal Entry</h3>
    <form onsubmit="createJournalEntry(event)">
        <div class="mb-2">
            <input type="text" class="form-control" id="description" placeholder="Description" required>
        </div>
        <div class="mb-2">
            <input type="text" class="form-control" id="reference" placeholder="Reference" required>
        </div>
        <div class="mb-2">
            <input type="date" class="form-control" id="date" required>
        </div>

        <h5>Line Items</h5>
        <div id="lineItems"></div>
        <button type="button" class="btn btn-secondary mb-2" onclick="addLineItem()">Add Line</button>
        <button type="submit" class="btn btn-success">Submit Entry</button>
    </form>
</div>

<script>
const API_BASE = "{{ url('/api') }}";

// Step 1: Populate accounts directly in JavaScript using Laravel Blade syntax
const accounts = @json($accounts); // Get accounts passed from the controller

function addLineItem() {
    // Step 2: Create the options dynamically for the select dropdown
    let options = `<option value="">Select Account</option>`; // Default empty option
    accounts.forEach(account => {
        options += `<option value="${account.id}">${account.name}</option>`; // Populate the account options
    });

    const html = `
    <div class="row mb-2">
      <div class="col-md-4">
        <select class="form-control account-id" required>
            ${options} <!-- This will fill the select dropdown with options -->
        </select>
      </div>
      <div class="col-md-3">
        <input type="number" step="0.01" class="form-control debit" placeholder="Debit">
      </div>
      <div class="col-md-3">
        <input type="number" step="0.01" class="form-control credit" placeholder="Credit">
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-danger" onclick="this.closest('.row').remove()">X</button>
      </div>
    </div>`;
    
    document.getElementById('lineItems').insertAdjacentHTML('beforeend', html);
}

function createJournalEntry(e) {
    e.preventDefault();

    const lines = [];
    document.querySelectorAll('#lineItems .row').forEach(row => {
        lines.push({
            account_id: row.querySelector('.account-id').value, // Get the selected account ID
            debit: parseFloat(row.querySelector('.debit').value || 0),
            credit: parseFloat(row.querySelector('.credit').value || 0),
        });
    });

    const data = {
        description: document.getElementById('description').value,
        reference: document.getElementById('reference').value,
        date: document.getElementById('date').value,
        lines: lines
    };

    console.log(data);

    fetch(`${API_BASE}/journal-entries`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {
        alert(response.message || JSON.stringify(response));
    })
    .catch(err => alert('Error: ' + err));
}

addLineItem(); 
addLineItem(); 

</script>
@endsection
