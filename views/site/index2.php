 <?php
    $data_api4 = file_get_contents('http://localhost:3000/api/persons');
    $json_api4 = json_decode($data_api4, true);
    ?>

<div class="panel panel-green">
        <div class="col-xl-6">
            <div class="box box-warning box-danger">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-book"></i> ประกาศสถานการณ์ </h3>
                </div>
                <div class="panel-body">

                    <div class="bs-example" data-example-id="contextual-table">
                        <table class="table table-striped  table-hover" id="dataTables-example">
                            <thead class='bg-info text-light'>
                                <tr>
                                    <th class='font-weight-bold'>Id</th> 
                                    <th class='font-weight-bold'>Sumpiset</th> 
                                    <th class='font-weight-bold'>Detail</th> 
                                    <th class='font-weight-bold'>Location</th> 
                                    <th class='font-weight-bold'>Recommend</th> 
                                    <th class='font-weight-bold'>AnnounceBy</th> 
                                    <th class='font-weight-bold'>Province</th> 
                                    <th class='font-weight-bold'>ProvinceEn </th>
                                    <th class='font-weight-bold'>Update</th>
                                </tr>
                            </thead>



                            <tbody>
                                <?php
                                foreach ($json_api4['data'] as $key => $value) {
                                    echo "<tr>";
                                    if (!is_array($value)) {
                                        echo "<td>" . $val . "</td> ";
                                    } else {
                                        foreach ($value as $key => $val) {
                                            echo "<td>" . $val . "</td> ";
                                        }
                                    }
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
