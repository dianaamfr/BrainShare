<ul class="nav ms-auto" id="order-filters">
    <li {{ app('request')->get('filter') != 'relevance' ? 'hidden' :  '' }}>
      <input id="order-filter-1" type="radio" name="filter" class="nav-link" value="relevance" hidden {{ app('request')->get('filter') == 'relevance' ? 'checked' : '' }}>
      <label for="order-filter-1">Relevance</label>
    </li>
    <li>
      <input id="order-filter-2" type="radio" name="filter" class="nav-link" value="new" hidden {{ app('request')->get('filter') ? (app('request')->get('filter') == 'new' ? 'checked' : '') : 'checked' }}>
      <label for="order-filter-2">Newest</label>
    </li>
    <li>
      <input id="order-filter-3" type="radio" name="filter" class="nav-link" value="votes" hidden {{ app('request')->get('filter') == 'votes' ? 'checked' : '' }}>
      <label for="order-filter-3">Most Voted</label>
    </li>
</ul>