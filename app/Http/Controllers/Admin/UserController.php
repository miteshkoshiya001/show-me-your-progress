<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\AppUser;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userCategories = Category::all();

        $query = AppUser::orderBy('id', 'desc');

        if ($request->has('user_category_id')) {
            $query->where('user_category_id', $request->input('user_category_id'));
        }

        $users = $query->get();

        foreach ($users as $user) {
            $userCategory = Category::find($user->user_category_id);
            $user->user_category = $userCategory ? $userCategory->name : 'N/A';
        }

        return view('admin.users.index', compact('users', 'userCategories'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json([
                'status' => true,
                'message' => 'Found',
                'data' => AppUser::findOrFail($id),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'No record found',
                'data' => [],
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            return response()->json([
                'status' => true,
                'message' => 'Found',
                'data' => AppUser::findOrFail($id),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'No record found',
                'data' => [],
            ]);
        }
        try {
            $user = AppUser::findOrFail($id);
            $userCategories = Category::all(); // Fetch all categories
            return view('admin.users.edit', compact('user', 'userCategories'));
        } catch (Exception $e) {
            // Handle the error and redirect back with a message

            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = AppUser::findOrFail($id);
            $request['status'] = !empty($request->status) ? 1 : 0;
            $user->update($request->all());
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => true,
                'message' => $e->getMessage(),
            ]);
            // Handle the error and redirect back with a message
            return redirect()->route('admin.users.index')->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = AppUser::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
        } catch (Exception $e) {
            // Handle the error and redirect back with a message
            return redirect()->route('admin.users.index')->with('error', 'Failed to delete user');
        }
    }
}
