<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8"/>
    <title>

        MyCMS | Softwiki Suporte Tecnológico

    </title>

</head>

<body style="background-color: #E5E5E5; padding: 50px;">

<div style="width: 400px; border-radius: 3px 3px 0 0; margin-left: auto; margin-right: auto;">

    <div style="color: #ffffff; width: 100%; background-color: #498EE9; margin: 0; border-radius: 3px 3px 0 0;">

        <h1 style="margin: 0; padding: 30px 30px 30px 30px; font-family:Helvetica; font-style:normal; font-weight:normal; letter-spacing:1px; line-height:130%; text-align:left; color:#FFFFFF">

            Softwiki Tecnologia,

            <strong>

                <?php echo utf8_encode(@(string)$resultDraftCompanies->name)?>

            </strong>

        </h1>

    </div>

    <div style="background-color: #ffffff; width: 100%; height: auto;">

        <div style="padding: 30px 30px 0 30px; margin: 0; font-family:Helvetica; font-style:normal; font-weight:normal; letter-spacing:1px; line-height:130%;">

            <?php echo utf8_encode(@(string)$EmailValidate->getText())?>

        </div>

        <div style="padding: 30px; font-family:Helvetica; font-style:normal; font-weight:normal; letter-spacing:1px; line-height:130%;">

            <table style="width: 100%; background-color: #E5E5E5; color: #333333; border-radius: 3px">

                <thead>

                <tr style="text-align: left;">

                    <th scope="col" style="padding: 10px">

                        Data

                    </th>

                    <th scope="col" style="padding: 10px">

                        Horário

                    </th>

                </tr>

                </thead>

                <tbody>

                <tr style="text-align: left;">

                    <td style="padding: 10px">

                        <?php echo date('d/m/Y')?>

                    </td>

                    <td style="padding: 10px">

                        <?php echo date('H:i:s')?>

                    </td>

                </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>