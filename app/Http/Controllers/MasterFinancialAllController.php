<?php 
namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\CustomFinancialEntry;
use App\Models\IncomeDetail;
use App\Models\Expense;

class MasterFinancialAllController extends Controller
{
    public function getFinancialData()
    {
        // Fetch all data from the tables
        $transfers = Transfer::all();
        $customFinancialEntries = CustomFinancialEntry::all();
        $incomeDetails = IncomeDetail::all();
        $expenses = Expense::all();
    
        // Check if data is fetched correctly
        if (!$transfers || !$customFinancialEntries || !$incomeDetails || !$expenses) {
            abort(500, 'Failed to fetch financial data.');
        }
    
        // Get authenticated user
        $user = auth()->user();

        // Return data to the view, including the authenticated user
        return view('financial.indexAll', compact('transfers', 'customFinancialEntries', 'incomeDetails', 'expenses', 'user'));
    }


    // Delete a Transfer record
    public function deleteTransfer($id)
    {
        $transfer = Transfer::find($id);

        if (!$transfer) {
            return redirect()->route('financial.indexAll')->with('error', 'Transfer not found.');
        }

        $transfer->delete();

        return redirect()->route('financial.indexAll')->with('success', 'Transfer deleted successfully.');
    }

    // Delete a CustomFinancialEntry record
    public function deleteCustomFinancialEntry($id)
    {
        $customFinancialEntry = CustomFinancialEntry::find($id);

        if (!$customFinancialEntry) {
            return redirect()->route('financial.indexAll')->with('error', 'Custom Financial Entry not found.');
        }

        $customFinancialEntry->delete();

        return redirect()->route('financial.indexAll')->with('success', 'Custom Financial Entry deleted successfully.');
    }

    // Delete an IncomeDetail record
    public function deleteIncomeDetail($id)
    {
        $incomeDetail = IncomeDetail::find($id);

        if (!$incomeDetail) {
            return redirect()->route('financial.indexAll')->with('error', 'Income Detail not found.');
        }

        $incomeDetail->delete();

        return redirect()->route('financial.indexAll')->with('success', 'Income Detail deleted successfully.');
    }

    // Delete an Expense record
    public function deleteExpense($id)
    {
        $expense = Expense::find($id);

        if (!$expense) {
            return redirect()->route('financial.indexAll')->with('error', 'Expense not found.');
        }

        $expense->delete();

        return redirect()->route('financial.indexAll')->with('success', 'Expense deleted successfully.');
    }

}
