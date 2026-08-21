<?php

declare(strict_types=1);

namespace App\Integration\Pdf;

final class SimplePdfGenerator
{
    /** @param list<string> $lignes */
    public function generer(array $lignes): string
    {
        $contenu = "BT\n/F1 18 Tf\n50 790 Td\n";
        foreach ($lignes as $index => $ligne) {
            if ($index > 0) { $contenu .= "0 -28 Td\n"; }
            $ligne = mb_strimwidth($ligne, 0, 90, '...');
            $texte = iconv('UTF-8', 'Windows-1252//TRANSLIT', $ligne) ?: $ligne;
            $contenu .= '('.str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $texte).") Tj\n";
            if ($index === 0) { $contenu .= "/F1 11 Tf\n"; }
        }
        $contenu .= "ET\n";

        $objets = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>',
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>',
            '<< /Length '.strlen($contenu)." >>\nstream\n".$contenu.'endstream',
        ];
        $pdf = "%PDF-1.4\n";
        $positions = [0];
        foreach ($objets as $numero => $objet) {
            $positions[] = strlen($pdf);
            $pdf .= ($numero + 1)." 0 obj\n".$objet."\nendobj\n";
        }
        $xref = strlen($pdf);
        $pdf .= "xref\n0 6\n0000000000 65535 f \n";
        for ($i = 1; $i <= 5; ++$i) { $pdf .= sprintf("%010d 00000 n \n", $positions[$i]); }
        return $pdf."trailer\n<< /Size 6 /Root 1 0 R >>\nstartxref\n{$xref}\n%%EOF\n";
    }
}
