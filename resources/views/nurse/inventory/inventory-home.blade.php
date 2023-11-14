@extends('adminlte::page')

<!-- Tabs Title -->
@section('title', 'Inventory')

<!-- Content Header -->
@section('content_header')
    <h1>Inventory</h1>
@stop

<!-- Content Body -->
@section('content')
<!-- Body -->
<div class="container-xxl mb-2 inventory-customize-container-height">
    <!-- Add and Search Item -->
    <div class="row">
        <!-- Adding new item button -->
        <div class="col">
            <div class="row">
                <div class="col-3" style="padding-top: 6px;">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropNew">Add New Item</button>
                </div>
                <div class="col-9">
                    @if($errors->has('name') || $errors->has('type') || $errors->has('quantity') || $errors->has('dosage'))
                    <div class="alert alert-danger">Adding fail, there must be missing credential or errors</div>
                    @endif
                    <!-- id Item already exist -->
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <!-- If Adding Item was a Success -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>


        <!-- Search Item -->
        <div class="col">
            <div class="row">
                <div class="col">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Search Item Name">
                </div>
                <button type="button" class="btn btn-primary" style="cursor: auto;" disabled><span class="fas fa-search "></span></button>
            </div>
        </div>
    </div>
    
    <!-- List table of Medicine and Equipment that have in Inventory -->
    <div class="mt-2 customize-table-container">
        <table class="table">
            <!-- Header of the table -->
            <thead>
                <tr>
                    <th class="th-position">Item Name</th>
                    <th class="th-position">Item Type</th>
                    <th class="th-position">Quantity</th>
                    <th class="th-position">Dosage (mg)</th>
                    <th class="th-position" style="text-align: center;">Update Item</th>
                </tr>
            </thead>
            <!-- Default body of the table -->
            <tbody class="inventory-content-default">
                <!-- Showing all items in the inventory table and each item will be called as "inventoryItem" -->
                @foreach($inventoryItems as $inventoryItem)
                <tr>
                    <td>{{ $inventoryItem->inventory_info->name }}</td>
                    <td>{{ $inventoryItem->inventory_info->type }}</td>
                    <td>{{ $inventoryItem->inventory_info->quantity }}</td>
                    <!-- If Item type is 'Medicine', show 'dosages' -->
                    <td>    
                        @if($inventoryItem->inventory_info->type == 'Medicine')
                        {{ $inventoryItem->inventory_info->dosage }} mg
                        @else
                        @endif
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <!-- Update Info Button -->
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#staticBackdropUpdate{{ $inventoryItem->inventory_info->id }}">Update Item</button>
                            </div>

                            <!-- Update Item Info Modal -->
                            <div class="modal fade" id="staticBackdropUpdate{{ $inventoryItem->inventory_info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $inventoryItem->inventory_info->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel{{ $inventoryItem->inventory_info->id }}">Update Item Info</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('nurse.inventoryUpdate', $inventoryItem->inventory_info->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col">
                                                        <label><b>Item Name:</b></label>
                                                        <input type="text" class="form-control" name="name" value="{{ old('name', $inventoryItem->inventory_info->name) }}" required>
                                                        @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label><b>Item Type:</b></label>
                                                        <select class="form-control update-inventory-add-select" data-modal-id="{{ $inventoryItem->inventory_info->id }}" data-item-type="{{ $inventoryItem->inventory_info->type }}" name="type">
                                                            <option value="Medicine" @if($inventoryItem->inventory_info->type == 'Medicine') selected @endif>Medicine</option>
                                                            <option value="Equipment" @if($inventoryItem->inventory_info->type == 'Equipment') selected @endif>Equipment</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- If 'type' is Medicine -->
                                                <div class="row update-choosen-medicine" id="update-choosen-medicine-{{ $inventoryItem->inventory_info->id }}">
                                                    <div class="col">
                                                        <label><b>Dosage:</b></label>
                                                        <input type="number" class="form-control" id="update-dosage1-status-{{ $inventoryItem->inventory_info->id }}" name="dosage" value="{{ old('dosage', $inventoryItem->inventory_info->dosage) }}">
                                                        @error('dosage')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- If 'type' is Equipment -->
                                                <div class="row update-choosen-equipment" id="update-choosen-equipment-{{ $inventoryItem->inventory_info->id }}" style="display: none;">
                                                    <div class="col">
                                                        <input type="hidden" class="form-control" id="update-dosage2-status-{{ $inventoryItem->inventory_info->id }}" name="dosage" value="0" disabled>
                                                    </div>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary float-right mt-3">Update Item</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Adding Quantity -->
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdropAdd{{ $inventoryItem->inventory_info->id }}">Add Quantity</button>
                            </div>

                            <!-- Adding Quantity Modal -->
                            <div class="modal fade" id="staticBackdropAdd{{ $inventoryItem->inventory_info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropAdd{{ $inventoryItem->inventory_info->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropAdd{{ $inventoryItem->inventory_info->id }}">Add Quantity</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('nurse.inventoryAdd', $inventoryItem->inventory_info->id) }}">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <label><b>Current Quantity:</b></label>
                                                        <input type="number" class="form-control" style="cursor: auto;" value="{{ $inventoryItem->inventory_info->quantity }}" readonly>
                                                    </div>
                                                    <div class="col text-center">
                                                        <label class="h1">+</label>
                                                    </div>
                                                    <div class="col">
                                                        <label><b>Quantity to be Add:</b></label>
                                                        <input type="number" class="form-control" id="quantity-status-1" name="add_quantity">
                                                    </div>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary float-right mt-3">Update Quantity</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reducing Quantity -->
                            <div class="col-4">
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropReduce{{ $inventoryItem->inventory_info->id }}">Reduce Quantity</button>
                            </div>

                            <!-- Reducing Quantity Modal -->
                            <div class="modal fade" id="staticBackdropReduce{{ $inventoryItem->inventory_info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropReduce{{ $inventoryItem->inventory_info->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropReduce{{ $inventoryItem->inventory_info->id }}">Deduct Quantity</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('nurse.inventoryReduce', $inventoryItem->inventory_info->id) }}">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <label><b>Current Quantity:</b></label>
                                                        <input type="number" class="form-control" style="cursor: auto;" value="{{ $inventoryItem->inventory_info->quantity }}" readonly>
                                                    </div>
                                                    <div class="col text-center">
                                                        <label class="h1">-</label>
                                                    </div>
                                                    <div class="col">
                                                        <label><b>Quantity to be Add:</b></label>
                                                        <input type="number" class="form-control" id="quantity-status-1" name="reduce_quantity">
                                                        @error('reduce_quantity')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary float-right mt-3">Update Quantity</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

            <!-- Search body of the table -->
            <tbody id="inventory-content" class="inventory-content-search">
                @foreach($inventory_infos as $inventory_info)
                <!-- Update Item Info Modal -->
                <div class="modal fade" id="staticBackdropUpdate{{ $inventory_info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $inventory_info->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel{{ $inventory_info->id }}">Update Item Info</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="POST" action="{{ route('nurse.inventoryUpdate', $inventory_info->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col">
                                            <label><b>Item Name:</b></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $inventory_info->name) }}" required>
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label><b>Item Type:</b></label>
                                            <select class="form-control update-inventory-add-select" data-modal-id="{{ $inventory_info->id }}" data-item-type="{{ $inventory_info->type }}" name="type">
                                                <option value="Medicine" @if($inventory_info->type == 'Medicine') selected @endif>Medicine</option>
                                                <option value="Equipment" @if($inventory_info->type == 'Equipment') selected @endif>Equipment</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- If 'type' is Medicine -->
                                    <div class="row update-choosen-medicine" id="update-choosen-medicine-{{ $inventory_info->id }}">
                                        <div class="col">
                                            <label><b>Dosage:</b></label>
                                            <input type="number" class="form-control" id="update-dosage1-status-{{ $inventory_info->id }}" name="dosage" value="{{ old('dosage', $inventory_info->dosage) }}">
                                            @error('dosage')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- If 'type' is Equipment -->
                                    <div class="row update-choosen-equipment" id="update-choosen-equipment-{{ $inventory_info->id }}" style="display: none;">
                                        <div class="col">
                                            <input type="hidden" class="form-control" id="update-dosage2-status-{{ $inventory_info->id }}" name="dosage" value="0" disabled>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary float-right mt-3">Update Item</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adding Quantity Modal -->
                <div class="modal fade" id="staticBackdropAdd{{ $inventory_info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropAdd{{ $inventory_info->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropAdd{{ $inventory_info->id }}">Add Quantity</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="POST" action="{{ route('nurse.inventoryAdd', $inventory_info->id) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col">
                                            <label><b>Current Quantity:</b></label>
                                            <input type="number" class="form-control" style="cursor: auto;" value="{{ $inventory_info->quantity }}" readonly>
                                        </div>
                                        <div class="col text-center">
                                            <label class="h1">+</label>
                                        </div>
                                        <div class="col">
                                            <label><b>Quantity to be Add:</b></label>
                                            <input type="number" class="form-control" id="quantity-status-1" name="add_quantity">
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary float-right mt-3">Update Quantity</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reducing Quantity Modal -->
                <div class="modal fade" id="staticBackdropReduce{{ $inventory_info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropReduce{{ $inventory_info->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropReduce{{ $inventory_info->id }}">Deduct Quantity</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="POST" action="{{ route('nurse.inventoryReduce', $inventory_info->id) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col">
                                            <label><b>Current Quantity:</b></label>
                                            <input type="number" class="form-control" style="cursor: auto;" value="{{ $inventory_info->quantity }}" readonly>
                                        </div>
                                        <div class="col text-center">
                                            <label class="h1">-</label>
                                        </div>
                                        <div class="col">
                                            <label><b>Quantity to be Add:</b></label>
                                            <input type="number" class="form-control" id="quantity-status-1" name="reduce_quantity">
                                            @error('reduce_quantity')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary float-right mt-3">Update Quantity</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
    {!! $inventoryItems->links('zomproj.customize-pagination', ['paginator' => $inventoryItems]) !!}
</div>

<!-- Add Item Modal -->
<div class="modal fade" id="staticBackdropNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adding Items</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('nurse.inventoryStore') }}" onsubmit="return confirm('Are you sure you want to add this item?');">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label><b>Item Name:</b></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label><b>Item Type:</b></label>
                            <select class="form-control" id="inventory-add-select">
                                <option>Medicine</option>
                                <option>Equipment</option>
                            </select>

                            <!-- Hidden 'type' input -->
                            <input type="hidden" name="type" id="type-value">
                        </div>
                    </div>

                    <!-- If 'type' is Medicine -->
                    <div class="row" id="choosen-medicine">
                        <div class="col">
                            <label><b>Quantity:</b></label>
                            <input type="number" class="form-control" id="quantity-status-1" name="quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label><b>Dosage:</b></label>
                            <input type="number" class="form-control" id="dosage-status" name="dosage" value="{{ old('dosage') }}">
                            @error('dosage')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- If 'type' is Equipment -->
                    <div class="row" id="choosen-equipment" style="display: none;">
                        <div class="col">
                            <label><b>Quantity:</b></label>
                            <input type="number" class="form-control" id="quantity-status-2" name="quantity" value="{{ old('quantity') }}" disabled>
                            @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary float-right mt-3">Add Item</button>
                </form>
            </div>
                
            <!-- Modal footer 
            <div class="modal-footer">
            </div>
            -->
        </div>
    </div>
</div>
@stop

<!-- CSS -->
@section('css')
    <!-- AdminLTE css -->
    <link rel="stylesheet" href="/css/admin_custom.css">

    <!-- ZomProj css -->
    <link rel="stylesheet" href="{{ asset('assets/css/inventory/zomproj-inventory.css') }}">
@stop

<!-- JavaScript -->
@section('js')
<!-- JQuery CDN (Content Delivery Network) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Bootstrap package -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Live Search on table -->
<script type="text/javascript">
    // This script listens for user input in the 'search' input field and triggers an action when a key is released.
    $('#search').on('keyup', function(){
        // Get the value entered by the user.
        $value=$(this).val();

        // default will be change into search if it has value
        if($value){
            $('.inventory-content-default').hide();
            $('.inventory-content-search').show();
        }else{
            $('.inventory-content-default').show();
            $('.inventory-content-search').hide();            
        }

        // Send an AJAX GET request to the server to perform a search using the user's input.
        $.ajax({
            type:'get',
            // Define the URL for the search request (likely configured in a Laravel route).
            url:'{{ route('nurse.inventorySearch') }}',
            // Send the user's input as search data.
            data:{'search':$value},

            // When the server responds successfully, update the page with the received data.
            success:function(data){
                // Replace the HTML content of an element with id 'Content' with the new data.
                $('#inventory-content').html(data)
            }
        });
    });
</script>

<!-- Adding Items (Change display depends on Select method) -->
<script>
    $(document).ready(function () {
        // Function to toggle form fields based on item type selection for adding items
        function toggleAddFields() {
            var itemType = $("#inventory-add-select").val();
            const type_value = $("#type-value");
            const quantity_status1 = $("#quantity-status-1");
            const quantity_status2 = $("#quantity-status-2");
            const dosage_status = $("#dosage-status");

            if (itemType === "Medicine") {
                $("#choosen-medicine").show();
                $("#choosen-equipment").hide();
                type_value.val('Medicine');
                quantity_status1.prop("disabled", false);
                quantity_status2.prop("disabled", true);
                dosage_status.prop("disabled", false);
            } else if (itemType === "Equipment") {
                $("#choosen-medicine").hide();
                $("#choosen-equipment").show();
                type_value.val('Equipment');
                quantity_status1.prop("disabled", true);
                quantity_status2.prop("disabled", false);
                dosage_status.prop("disabled", true);
            }
        }

        // Initial call to toggle fields based on the default selected item type for adding items
        toggleAddFields();

        // Attach an event handler to the item type select field for adding items
        $("#inventory-add-select").on("change", function () {
            toggleAddFields();
        });
    });
</script>

<!-- Update Items (Change display depends on Select method) -->
<script>
    $(document).ready(function () {
        // Function to toggle form fields based on item type selection for updating items
        $(".update-inventory-add-select").on("change", function () {
            var modalId = $(this).data("modal-id");
            const update_DosageStatus1 = $("#update-dosage1-status-" + modalId);
            const update_DosageStatus2 = $("#update-dosage2-status-" + modalId);
            const initialDosage = update_DosageStatus1.data("dosage"); // Read the data-dosage attribute

            if ($(this).val() === "Medicine") {
                $("#update-choosen-medicine-" + modalId).show();
                $("#update-choosen-equipment-" + modalId).hide();
                update_DosageStatus1.prop("disabled", false);
                update_DosageStatus2.prop("disabled", true);
            } else if ($(this).val() === "Equipment") {
                $("#update-choosen-medicine-" + modalId).hide();
                $("#update-choosen-equipment-" + modalId).show();
                update_DosageStatus1.prop("disabled", true);
                update_DosageStatus2.prop("disabled", false);
            }
        });

        // Initial call to toggle fields based on the default selected item type for updating items
        $(".update-inventory-add-select").trigger("change");
    });
</script>
@stop