<ul class="nav ms-auto" id="order-filters">
    <li {{ old('nav-search-input') ? '' : 'hidden' }}>
      <input id="order-filter-1" type="radio" name="filter" class="nav-link" value="relevance" hidden {{ old('nav-search-input') ? 'checked' : '' }}>
      <label for="order-filter-1">Relevance</label>
    </li>
    <li>
      <input id="order-filter-2" type="radio" name="filter" class="nav-link" value="new" hidden {{ old('nav-search-input') ? '' : 'checked' }}>
      <label for="order-filter-2">Newest</label>
    </li>
    <li>
      <input id="order-filter-3" type="radio" name="filter" class="nav-link" value="votes" hidden>
      <label for="order-filter-3">Most Voted</label>
    </li>
</ul>