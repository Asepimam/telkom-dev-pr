<?php

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

class transaksi extends CI_Controller
{

    public function index()
    {
        // Menggunakan model untuk mengambil data transaksi dengan JOIN ke tabel customer
        $data['transaksi'] = $this->user_model->get_edituser();

        $this->load->view('templates/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/edituser', $data);
        $this->load->view('templates/footer');
    }


    public function delete($id_dokumen)
    {
        // Fungsi ini akan menangani penghapusan data berdasarkan $id_dokumen
        $this->user_model->delete_data(array('id_dokumen' => $id_dokumen), 'transaksi');

        // Kirim respons yang mengindikasikan berhasil
        redirect('admin/transaksi');
    }


    public function terima($id_terima)
    {
        // Fungsi ini akan menangani penghapusan data berdasarkan $id_dokumen
        $this->user_model->terima_data(array('id_dokumen' => $id_terima), 'transaksi');

        // Kirim respons yang mengindikasikan berhasil
        redirect('admin/transaksi');
    }


    public function download($id_dokumen)
    {
        // Retrieve the document file based on the $id_dokumen
        $document = $this->user_model->get_document_by_id($id_dokumen);

        if (!empty($document)) {
            // Path to the document file
            $file_path = 'path_to_your_document_directory/' . $document->dokumen;

            // Check if the file exists
            if (file_exists($file_path)) {
                // Load the download helper
                $this->load->helper('download');

                // Set the appropriate MIME type for your file (e.g., application/pdf, application/msword, etc.)
                $mime_type = 'application/pdf'; // Adjust as needed

                // Trigger the file download
                force_download($file_path, NULL, $mime_type);
            } else {
                // File not found
                echo "File not found.";
            }
        } else {
            // Document with the given ID not found
            echo "Document not found.";
        }
    }
    public function qrcode($id_dokumen)
    {
        $data['row'] = $this->user_model->get($id_dokumen)->row();
        $this->tamplate->load('tamplate', 'admin/qrcode');
    }

    public function generate_qrcode($id_dokumen)
    {
        // Check if the QR Code already exists in the database
        $existing_qrcode = $this->user_model->get_qrcode($id_dokumen);

        if ($existing_qrcode) {
            // If the QR Code already exists, you can return or do something else.
            // You may want to provide a message or redirect.
            // For now, we will just redirect back to the index.
            redirect('admin/transaksi');
        } else {
            // Generate a unique QR Code content based on the ID
            $qrCodeContent = "UniqueContent_" . $id_dokumen;

            // Generate QR Code using your preferred library (e.g., Endroid QR Code library)
            $writer = new PngWriter();
            $qrCode = QrCode::create($qrCodeContent);

            try {
                // Render the QR Code image
                $result = $writer->write($qrCode);
            } catch (ValidationException $e) {
                // Handle validation exception
                $result = null;
            }

            if ($result) {
                // Save the QR Code image to the ./assets/qrcode/ directory
                $qrcodeFileName = 'qrcode_' . $id_dokumen . '.png';
                $qrcodeFilePath = './assets/qrcode/' . $qrcodeFileName;
                file_put_contents($qrcodeFilePath, $result->getString());

                // Update the 'qrcode' column in the 'transaksi' table
                $this->user_model->update_qrcode($id_dokumen, $qrcodeFileName);

                // Redirect to the index page or provide a success message
                redirect('admin/transaksi');
            } else {
                // Handle QR Code generation failure
                // You may want to provide an error message or take appropriate action.
                // For now, we will just redirect back to the index.
                redirect('admin/transaksi');
            }
        }
    }

    public function coba_qrcode()
    {
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create('12345')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        $logo = Logo::create(__DIR__ . '/assets/symfony.png')
            ->setResizeToWidth(50)
            ->setPunchoutBackground(true);

        // Create generic label
        $label = Label::create('Label')
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        // Validate the result
        $writer->validateResult($result, '12345');
        // Directly output the QR code
        header('Content-Type: ' . $result->getMimeType());
        echo $result->getString();
    }
}
