<?php

function insertReview($invId, $clientId, $reviewText) {
    $db = acmeConnect();
    $sql = 'INSERT INTO reviews (invId, clientId, reviewText) VALUES (:invId, :clientId, :reviewText)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getReviewInvItem($invId) {
    $db = acmeConnect();
    $sql = 'SELECT * FROM reviews AS r INNER JOIN clients AS c ON r.clientId = c.clientId WHERE r.invId = :invId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewArray;
}

function getReviewByClient($clientId) {
    $db = acmeConnect();
    $sql = 'SELECT * FROM reviews AS r INNER JOIN inventory AS i ON r.invId = i.invId WHERE r.clientId = :clientId ORDER BY clientId DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewArray;
}

function getReview($reviewId) {
    $db = acmeConnect();
    $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId ORDER BY reviewId ASC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewArray;
}

function updateReview($reviewText, $reviewId) {
    $db = acmeConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function deleteReview($reviewId) {
    $db = acmeConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getReviewsCurrent($reviewId){
    $db = acmeConnect(); 
    $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();  
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();  
    return $review;
}