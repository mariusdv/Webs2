
<div class="container">
    <table class="table table-hover">
        <caption>Urenverantwoording</caption>
        <thead>
        <tr>
            <th>Datum</th>
            <th>Naam</th>
            <th>Taak</th>
            <th>Uren</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$rows item=row}
        <tr>
            <td>{$row->Date}</td>
            <td>{$row->Name}</td>
            <td>{$row->Task}</td>
            <td>{$row->Time}</td>
        </tr>
        {/foreach}
        </tbody>
    </table>

    <p>
        Totaal Marius: {$Marius}
    </p>
    <p>
        Totaal Patrick: {$Patrick}
    </p>
</div>

