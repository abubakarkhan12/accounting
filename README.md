API Usage

Create Journal Entry

POST (http://127.0.0.1:8000/api/journal-entries)

Headers:

Content-Type: application/json

Accept: application/json

Request Body Example:

{
  "description": "Monthly Rent Payment",
  "reference": "REF2025-001",
  "date": "2025-05-10",
  "lines": [
    {
      "account_id": 1,
      "debit": 1000,
      "credit": 0
    },
    {
      "account_id": 2,
      "debit": 0,
      "credit": 1000
    }
  ]
}

---------------------------------------------------------------

Project Structure

app/Models/JournalEntry.php

app/Models/JournalEntryLine.php

app/Http/Controllers/JournalEntryController.php

Blade View: resources/views/journal-create.blade.php

Routes:

routes/web.php

routes/api.php
