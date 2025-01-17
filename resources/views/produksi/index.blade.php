

<div class="container-fluid flex-grow-1">
    <h3 class="my-4 judul"> {{ $title }} </h3>
    <div class="card border-light mb-3">
      <div class="card-body">
        <div class="row"> 
          <div class="col">
            <h5 class="my-4 mx-2"> 
              <i class="material-icons-round bi me-2">{{ $icon }}</i>
              {{ $ket }}{{ $title }} 
            </h5>
          </div>
          @if(Auth::user()->hasRole('Manager Finance') || Auth::user()->hasRole('Admin'))
          <div class="col">
              <a href="{{ route('accproduksi') }}" class="btn aksi-btn2 text-white mx-2 float-end " >History</a>
          </div>
          @endif
  
        </div>
  
        <div class="row my-4">
          <span class="my-2 mx-2-lg fs-7" style="color: #5C5858"> 
            Cari Berdasarkan
          </span>
          <div class="col">
                <div class="input-group mx-2-lg mb-4" id="select-filter">
                  <select wire:model="col_selected" class="selection form-select" id="itemType" name="item_type" aria-label=".form-select-sm example">
                    <option value= "0">Choose Columns</option>
                    @foreach ($columns as $columns_id => $columns_name)
                     <option value="{{ $columns_id }}">{{ $columns_name }}</option>
                    @endforeach
                    
                  </select>
                  <input wire:model="search" class="form-control" style="width:20rem" id="exampleInputEmail1" aria-describedby="emailHelp" name="search" placeholder="search..">
                </div>
          </div>
          <div class="col">
            <div class="input-group mx-auto-sm mb-4" id="select-filter">
              <select class="selection form-select" wire:model="selectedStatus" id="itemType" name="item_type" aria-label=".form-select-sm example">
                <option value= "0">ALL</option>
                @foreach ($status as $status)
                 <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
                
              </select>
            </div>
          </div>
          <div class="col">
            <div class="row">
              <div class="d-flex">
                <label class="mx-2 py-2">From</label>
                <input wire:model="date_from" type="date" class="form-date form-control d-inline"  
                  wire:model="searchColumnsDateMin" />
                <label class="mx-2 py-2">to</label>
                <input wire:model="date_to" type="date" class="form-date form-control d-inline" 
                 wire:model="searchColumnsDateMax" />
              </div>
            </div>
            @if (($date_from  > $date_to) && (!empty($date_to)) )
            <div class="row">
              <span class="info-filter">Masukkan tanggal dengan benar </span>
            </div>
              
                
            @endif
          </div>
        </div>
  <div class="table-responsive">
    <table class="table">
      {{-- table heading --}}
        <thead>
          <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col" >
              <span class="d-flex justify-content-center">
                Tanggal
                <i wire:click="sortBy('created_at')" style="cursor: pointer" class="material-icons-round {{ $sortBy === 'created_at' && $sortDirection === 'desc' ? '' : 'no-use' }}">arrow_drop_down</i>
              </span> 
            </th> 
            <th  scope="col" >
              <span class="d-flex justify-content-center">
                No Quotation
                <i wire:click="sortBy('quotation_no')" style="cursor: pointer" class="material-icons-round {{ $sortBy === 'quotation_no' && $sortDirection === 'desc' ? '' : 'no-use' }}">arrow_drop_down</i>
              </span> 
            </th>               
            <th  scope="col" >
              <span class="d-flex justify-content-center">
                No FPPP
                <i wire:click="sortBy('fppp_no')" style="cursor: pointer" class="material-icons-round {{ $sortBy === 'fppp_no' && $sortDirection === 'desc' ? '' : 'no-use' }}">arrow_drop_down</i>
              </span> 
            </th>
            <th  scope="col" >
              <span class="d-flex justify-content-center">
                Aplikator
                <i wire:click="sortBy('applicator_name')" style="cursor: pointer" class="material-icons-round {{ $sortBy === 'applicator_name' && $sortDirection === 'desc' ? '' : 'no-use' }}">arrow_drop_down</i>
              </span>
            </th>
            <th  scope="col">
              <span class="d-flex justify-content-center">
                Nama Projek
                <i wire:click="sortBy('project_name')" style="cursor: pointer" class="material-icons-round {{ $sortBy === 'project_name' && $sortDirection === 'desc' ? '' : 'no-use' }}">arrow_drop_down</i>
              </span>
            </th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        {{-- table body --}}
        <tbody>
          @foreach ($items as $d=>$item)
                  <tr class="items-align-center">
                    <th scope="row">{{ $items->firstItem() + $d}}</th>
                    <td>{{ $item -> date }}</td>
                    <td>{{ $item -> no_quotation }}</td>
                    <td>{{ $item -> fppp_no }}</td>
                    <td>{{ $item -> aplikator }}</td>
                    <td>{{ $item -> nama_proyek }}</td>
                    <td class="p-4 text-center">
                      <button class="status  p-2 btn btn-outline-light"  wire:click.prevent = "statusChangedConfirmation({{ $item->id }})" {{$item->status_disable}} style="background-color: {{ $item -> status_color }}; color:{{ $item-> status_text_color }};font-size:13px">{{ $item -> acc_produksi }}</button>
                    </td> 
                  </tr>
          @endforeach
        </tbody>
      </table>
  </div>
   
    {{-- pagination   --}}
    {{ $items -> links() }}
  
  </div>
  </div>
  </div>
  
  
  