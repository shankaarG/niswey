<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContactController extends Controller
{
    // List all contacts
    public function index()
    {
        return response()->json(Contact::all());
    }

    // Store a new contact
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $contact = Contact::create($request->all());
        return response()->json($contact, 201);
    }

    // Show a single contact
    public function show($id)
    {
        return response()->json(Contact::findOrFail($id));
    }

    // Update a contact
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return response()->json($contact);
    }

    // Delete a contact
    public function destroy($id)
    {
        Contact::destroy($id);
        return response()->json(['message' => 'Contact deleted successfully']);
    }

    // Bulk Import from XML
    public function importXML(Request $request)
    {
		
        $file = $request->file('xml_file');
        
        if (!$file || !$file->isValid()) {
            return response()->json(['error' => 'Invalid file upload'], 400);
        }
        
        $xml = simplexml_load_file($file->getRealPath());
        
        foreach ($xml->contact as $contact) {
            Contact::create([
                'name' => (string) $contact->name,
                'phone' => (string) $contact->phone
            ]);
        }
        
        return response()->json(['message' => 'Contacts imported successfully']);
    }
}

?>