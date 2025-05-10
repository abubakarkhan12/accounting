@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Journal Entries</h3>
    <button class="btn btn-primary mb-3" onclick="loadJournalEntries()">Load Entries</button>
    <div id="entriesList"></div>
</div>

<script>
const API_BASE = "{{ url('/api') }}";

function loadJournalEntries() {
    fetch(`${API_BASE}/journal-entries`)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('entriesList');
            container.innerHTML = '';
            data.forEach(entry => {
                let html = `
                <div class="card mb-2">
                    <div class="card-body">
                        <h5>${entry.description} (${entry.reference})</h5>
                        <p>Date: ${entry.date}</p>
                        <table class="table table-sm">
                            <thead><tr><th>Account</th><th>Debit</th><th>Credit</th></tr></thead>
                            <tbody>
                            ${entry.lines.map(line =>
                                `<tr>
                                    <td>${line.account.name}</td>
                                    <td>${line.debit}</td>
                                    <td>${line.credit}</td>
                                </tr>`).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>`;
                container.innerHTML += html;
            });
        });
}

loadJournalEntries();
</script>
@endsection
