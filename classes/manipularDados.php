<?php

include_once("conexao.php");

class ManipularDados {
    
    public function verificarCredenciais($username, $password) {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        
        $sql = "SELECT * FROM tbusers WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cadastrarUsuario($username, $password) {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

    
        $sql = "INSERT INTO tbusers (username, password) VALUES ('$username', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    
    public function atualizarBiografia($username, $bio) {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $username = mysqli_real_escape_string($conn, $username);
        $bio = mysqli_real_escape_string($conn, $bio);

        $sql = "UPDATE tbusers SET bio = '$bio' WHERE username = '$username'";
        
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function recuperarBiografia($username) {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $username = mysqli_real_escape_string($conn, $username);
    
        $sql = "SELECT bio FROM tbusers WHERE username = '$username'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['bio'];
        } else {
            return false;
        }
    }
    

    public function exibirPosts() {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $sql = "SELECT * FROM tbposts ORDER BY codPost DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<div class='post-header'>";
                echo "<img src='../img/profilePicture/defaultIcon.png' alt=''  class='profile_picture'>";
                echo "<span class='post-autor'>" . $row['autor'] . " </span>";
                echo "<span class='post-date'>" . $row["dataPost"] . "</span>";
                echo "<div class='dropdown'>
                    <button class='dropbtn'>&#8942;</button>
                    <div class='dropdown-content'>
                        <a href='index.php' class='deleteButton' data-post-id='" . $row["codPost"] . "'>Excluir</a>
                    </div>
                </div>";
                echo "</div>";
                echo "<br /><div class='post-content'>" . $row["textPost"] . "</div>";
                echo "<br />";
                echo "<div class='post-actions'>
                    <button class='likeButton' data-post-id='" . $row["codPost"] . "'>&#x2661;
                    <span class='likeCount'>" . $row['likePost'] . "</span></button>
                    </div>";
                echo "</div>";
                echo "<br>";
            }
        } else {
            echo "0 resultados";
        }
    }

    public function adicionarLike($codPost, $username) {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();

        $sqlCheckLike = "SELECT * FROM tblikes WHERE codPost = ? AND username = ?";
        $stmtCheckLike = $conn->prepare($sqlCheckLike);
        $stmtCheckLike->bind_param("is", $codPost, $username);
        $stmtCheckLike->execute();
        $resultCheckLike = $stmtCheckLike->get_result();
    
        if ($resultCheckLike->num_rows > 0) {
            return "Você já curtiu este post!";
        }
    
        $sqlAddLike = "UPDATE tbposts SET likePost = likePost + 1 WHERE codPost = ?";
        $stmtAddLike = $conn->prepare($sqlAddLike);
        $stmtAddLike->bind_param("i", $codPost);
    
        if ($stmtAddLike->execute()) {

            $sqlRegisterLike = "INSERT INTO tblikes (codPost, username) VALUES (?, ?)";
            $stmtRegisterLike = $conn->prepare($sqlRegisterLike);
            $stmtRegisterLike->bind_param("is", $codPost, $username);
            $stmtRegisterLike->execute();
            
            return "Like adicionado com sucesso!";
        } else {
            return "Erro ao adicionar like: " . $stmtAddLike->error;
        }
    
        $stmtCheckLike->close();
        $stmtAddLike->close();
        $stmtRegisterLike->close();
    }
    
    
    public function inserirPost($content, $autor) {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $sql = "INSERT INTO tbposts (textPost, autor, dataPost) VALUES (?, ?, CURRENT_TIMESTAMP)";
        
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ss", $content, $autor);
        
        if ($stmt->execute()) {
            echo "Post inserido com sucesso!";
        } else {
            echo "Erro ao inserir post: " . $conn->error;
        }

        $stmt->close();
    }
    
    
    public function deletarPost($codPost){
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $sqlDeleteLikes = "DELETE FROM tblikes WHERE codPost = ?";
        $stmtDeleteLikes = $conn->prepare($sqlDeleteLikes);
        $stmtDeleteLikes->bind_param("i", $codPost);
        $stmtDeleteLikes->execute();

        $sqlDeletePost = "DELETE FROM tbposts WHERE codPost = ?";
        $stmtDeletePost = $conn->prepare($sqlDeletePost);
        $stmtDeletePost->bind_param("i", $codPost);
        $stmtDeletePost->execute();
        
        if ($stmtDeletePost->affected_rows > 0) {
            echo "Post deletado com sucesso!";
        } else {
            echo "Erro ao deletar post: " . $stmtDeletePost->error;
        }
        
        $stmtDeleteLikes->close();
        $stmtDeletePost->close();
    }
    
    
}
?>