
<?php
require('fpdf/fpdf.php');
require('conexao.php');

if (isset($_GET['id'])) {
    $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']);
    $sql = "SELECT * FROM usuarios WHERE id = '$usuario_id'";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        // Create a new PDF instance
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Add content to the PDF
        $pdf->Cell(40, 10, 'Detalhes do Usuario');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);
        foreach ($usuario as $key => $value) {
            $pdf->Cell(0, 10, ucfirst($key) . ': ' . $value, 0, 1);
        }

        // Output the PDF
        $pdf->Output('I', 'usuario_' . $usuario_id . '.pdf');
    } else {
        echo "Usuario nao encontrado.";
    }
} else {
    echo "ID do usuario nao fornecido.";
}
?>
