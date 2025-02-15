<?php
namespace App\Controllers;

use App\Models\Transaction;
use App\Database\Database;

class TransactionController {
    private $transactionModel;

    public function __construct() {
        $pdo = Database::connect();
        $this->transactionModel = new Transaction($pdo);
    }

    public function getAllTransaction() : void {
        $transactions = $this->transactionModel->getAll();
        if ($transactions || $transactions === []) {
            http_response_code(201);
            echo $transactions === [] ? json_encode(["message" => "La table est vide"]) : json_encode($transactions);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la récupération des transactions"]);
        }
    }

    public function addTransaction(array $data) : void {
        if ($data === null) {
            http_response_code(400); // Mauvaise requête
            echo json_encode(["message" => "Invalid JSON"]);
            exit;
        }

        $addTransactions = $this->transactionModel->add($data);
        if ($addTransactions) {
            http_response_code(201);
            echo json_encode(["message" => "La transaction a été ajouté avec succès"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de l'ajout d'une transaction et de ses catégories"]);
        }

    }

    public function deleteTransaction(int $id)  : void {
        if (!$id) {
            http_response_code(400); // Mauvaise requête
            echo json_encode(["message" => "Requête invalide"]);
            exit;
        }

        $delTransaction = $this->transactionModel->delete($id);
        if ($delTransaction) {
            http_response_code(201);
            echo json_encode(["message" => "La transaction a été supprimé avec succès"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la suppression d'une transaction et de ses catégories"]);
        }

    }

    public function getAllFromUserId(int $id_user)  : void {
        if (!$id_user) {
            http_response_code(400); // Mauvaise requête
            echo json_encode(["message" => "Requête invalide"]);
            exit;
        }

        $transactions = $this->transactionModel->getAllFromUser($id_user);
        if ($transactions || $transactions === []) {
            http_response_code(201);
            echo $transactions === [] ? json_encode(["message" => "Cet utilisateur n'a pas de transactions"]) : json_encode($transactions);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la récupération des transactions de cet utilisateur"]);
        }
    }

    public function updateTransaction(int $id, array $data)  : void {
        if (!$id || !$data) {
            http_response_code(400); // Mauvaise requête
            echo json_encode(["message" => "Requête invalide",]);
            exit;
        }

        $updTransaction = $this->transactionModel->update($id,$data);
        if ($updTransaction) {
            http_response_code(201);
            echo json_encode(["message" => "La transaction a été modifié avec succès"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la modification d'une transaction ou de ses catégories"]);
        }
    }

    public function getTransactionById(int $id)  : void {
        if (!$id) {
            http_response_code(400); // Mauvaise requête
            echo json_encode(["message" => "Requête invalide"]);
            exit;
        }

        $transaction = $this->transactionModel->getById($id);
        if ($transaction || $transaction === []) {
            http_response_code(201);
            echo $transaction === [] ? json_encode(["message" => "Cet transaction n'existe pas"]) : json_encode($transaction);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la récupération de la transaction"]);
        }
    }
}
