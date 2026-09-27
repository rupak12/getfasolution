<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReorderMenuItemsRequest;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use App\Http\Requests\Admin\UpdateMenuItemRequest;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuSettingsController extends Controller
{
    public function index(): View
    {
        return view('admin.menu.index', [
            'menuItems' => MenuItem::adminTree(),
            'routes' => config('menu_routes', []),
            'parents' => MenuItem::query()->whereNull('parent_id')->orderBy('sort_order')->get(),
        ]);
    }

    public function store(StoreMenuItemRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);

        if ($data['parent_id'] ?? null) {
            $parent = MenuItem::query()->findOrFail($data['parent_id']);
            abort_if($parent->parent_id !== null, 422, 'Submenus can only be added under top-level menu items.');

            $data['sort_order'] = MenuItem::query()
                ->where('parent_id', $data['parent_id'])
                ->max('sort_order') + 1;
        } else {
            $data['sort_order'] = MenuItem::query()
                ->whereNull('parent_id')
                ->max('sort_order') + 1;
        }

        if (empty($data['route_name']) && empty($data['custom_url'])) {
            $data['custom_url'] = '#';
        }

        MenuItem::create($data);
        MenuItem::refreshCache();

        return back()->with('status', 'Menu item added successfully.');
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if (empty($data['route_name']) && empty($data['custom_url'])) {
            $data['custom_url'] = '#';
        }

        $menuItem->update($data);
        MenuItem::refreshCache();

        return back()->with('status', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();
        MenuItem::refreshCache();

        return back()->with('status', 'Menu item deleted successfully.');
    }

    public function reorder(ReorderMenuItemsRequest $request): JsonResponse
    {
        $this->applyOrder($request->validated('items'));

        MenuItem::refreshCache();

        return response()->json([
            'message' => 'Menu order saved successfully.',
        ]);
    }

    private function applyOrder(array $items, ?int $parentId = null): void
    {
        if ($parentId !== null) {
            $parent = MenuItem::query()->find($parentId);
            abort_if($parent && $parent->parent_id !== null, 422, 'Only one submenu level is allowed.');
        }

        foreach ($items as $index => $item) {
            MenuItem::query()
                ->whereKey($item['id'])
                ->update([
                    'parent_id' => $parentId,
                    'sort_order' => $index + 1,
                ]);

            if (! empty($item['children'])) {
                $this->applyOrder($item['children'], (int) $item['id']);
            }
        }
    }
}
