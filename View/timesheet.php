<div class="container-fluid">
    <div class="row">
        <!-- Bootstrap 3 panel list. -->
        <div id="draggablePanelList">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <!--Sidebar content-->
                    <div class="panel-heading">Taak Toevoegen</div>
                    <div class="panel-body">
                        <form class="form" method="post" action="/timesheet">
                            <div class="form-group">
                                <label>Naam: </label>
                                <select name="name" class="form-control input-sm">
                                    <option value="Marius">Marius</option>
                                    <option value="Patrick">Patrick</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Taak: </label>
                                <input name="task" class="form-control input-sm" type="text"
                                       placeholder="Ik ben zo productief bezig...">
                            </div>
                            <div class="form-group">
                                <label>Uren: </label>
                                <input name="hours" class="form-control input-sm" type="number" min="0"
                                       placeholder="0">
                            </div>
                            <div >
                                <button type="submit" class="btn btn-primary">Opslaan</button>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <div class="h4">
                            <p>
                                <strong>Totaal Marius:</strong> {$Marius}
                            </p>
                            <p>
                                <strong>Totaal Patrick:</strong> {$Patrick}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">Urenverantwoording</div>
                    <!--Body content-->
                    <table class="table table-hover sortable">
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
    </div>
</div>

<script src="../JS/Sortable.js"></script>
<script src="../JS/DragPanel.js"></script>
