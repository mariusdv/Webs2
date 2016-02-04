<div class="container-fluid">
    <div class="row">
        <div style="height: 30px; background-color: #337ab7; margin-bottom: 30px;"></div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <!--Sidebar content-->
            <div class="panel panel-primary">
                <div class="panel-heading">Taak Toevoegen</div>
                <form class="form" style="padding: 25px;">
                    <div class="form-group">
                        <label>Naam: </label>
                        <select class="form-control input-sm">
                            <option value="Marius">Marius</option>
                            <option value="Patrick">Patrick</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="task">Taak: </label>
                        <input id="task" class="form-control input-sm" type="text" placeholder="Ik ben zo productief bezig...">
                    </div>
                    <div class="form-group">
                        <label for="hours">Uren: </label>
                        <input id="hours" class="form-control input-sm" type="number" min="0" placeholder="0">
                    </div>
                    <div align="center">
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </form>
                <div class="h4" align="center" style="padding-bottom: 20px;">
                    <p>
                        <strong>Totaal Marius:</strong> {$Marius}
                    </p>
                    <p>
                        <strong>Totaal Patrick:</strong> {$Patrick}
                    </p>
                </div>
            </div>
            </div>
            <div class="col-md-10">
                <!--Body content-->

                <table class="table table-hover">
                    <caption class="h2">Urenverantwoording</caption>
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

            </div>

        </div>

    </div>