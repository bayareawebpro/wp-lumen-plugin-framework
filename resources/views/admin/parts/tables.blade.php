<table class="widefat striped">
    <tbody>
    <tr>
        <td class="row-title">
            <a href="#" title="Item One">Item One</a>
        </td>
        <td class="desc">Short item description</td>
    </tr>
    <tr>
        <td class="row-title">
            <a href="#" title="Item Two">Item Two</a>
        </td>
        <td class="desc">Short item description</td>
    </tr>
    <tr>
        <td class="row-title">
            <a href="#" title="Item Three">Item Three</a>
        </td>
        <td class="desc">Short item description</td>
    </tr>
    <tr>
        <td class="row-title">
            <a href="#" title="Item Four">Item Four</a>
        </td>
        <td class="desc">Short item description</td>
    </tr>
    </tbody>
</table>




<table class="wp-list-table widefat fixed striped">
    <thead>
    <tr>
        <th scope="col" class="column-primary">Event</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Location</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="column-primary" data-colname="Event">
            WordCamp Metropolis
            <button type="button" class="toggle-row">
                <span class="screen-reader-text">Show more details</span>
            </button>
        </td>
        <td data-colname="Start Date">
            2020-01-01
        </td>
        <td data-colname="End Date">
            2020-01-04
        </td>
        <td data-colname="Location">
            The Daily Planet
        </td>
    </tr>
    <tr>
        <td class="column-primary" data-colname="Event">
            WordCamp Jupiter Station
            <button type="button" class="toggle-row">
                <span class="screen-reader-text">Show more details</span>
            </button>
        </td>
        <td data-colname="Start Date">
            2370-01-01
        </td>
        <td data-colname="End Date">
            2370-01-04
        </td>
        <td data-colname="Location">
            Holodeck 4
        </td>
    </tr>
    </tbody>
</table>



<table class="wp-list-table widefat fixed striped">
    <thead>
    <tr>
        <td id="cb" class="column-cb check-column">
            <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
            <input id="cb-select-all-1" type="checkbox">
        </td>
        <th scope="col" class="column-primary">Event</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Location</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row" class="check-column">
            <label class="screen-reader-text" for="user_1">Select WordCamp</label>
            <input type="checkbox" name="events[]" value="1">
        </th>
        <td class="column-username has-row-actions column-primary" data-colname="Event">
            <img src="/wp-content/plugins/patterns/admin/img/60.png"
                 class="avatar avatar-32 photo" width="32" height="32" />
            <strong><a href="#">WordCamp Philly</a></strong><br>
            <div class="row-actions">
					<span>
						<a href="#">Edit Event</a> |
					</span>
                <span>
						<a href="#">View Event</a>
					</span>
            </div>
            <button type="button" class="toggle-row">
                <span class="screen-reader-text">Show more details</span>
            </button>
        </td>
        <td data-colname="Start Date">2016 </td>
        <td data-colname="End Date">2017</td>
        <td data-colname="Location">Philly</td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td id="cb" class="column-cb check-column">
            <label class="screen-reader-text" for="cb-select-all-2">Select All</label>
            <input id="cb-select-all-2" type="checkbox">
        </td>
        <th scope="col" class="column-primary">Event</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Location</th>
    </tr>
    </tfoot>
</table>