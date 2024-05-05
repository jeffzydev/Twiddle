function toggleThemeMenu() {
    var themeMenu = document.getElementById("themeMenu");
    themeMenu.style.display = themeMenu.style.display === "block" ? "none" : "block";
    if (themeMenu.classList.contains("slide-in")) {
        themeMenu.classList.remove("slide-in");
        themeMenu.classList.add("slide-out");
    } else {
        themeMenu.classList.remove("slide-out");
        themeMenu.classList.add("slide-in");
    }
}

function closeThemeMenu() {
    var themeMenu = document.getElementById("themeMenu");
    themeMenu.classList.remove("slide-in");
    themeMenu.classList.add("slide-out");
    setTimeout(function() {
        themeMenu.style.display = "none";
    }, 1000);
}


document.getElementById("themeButton").addEventListener("click", toggleThemeMenu);

document.getElementById("lightThemeOption").addEventListener("click", function() {
    document.body.classList.remove("dark-mode");
    document.body.classList.remove("blue-mode");
    document.body.classList.add("light-mode");
    localStorage.setItem("theme", "light");
});

document.getElementById("darkThemeOption").addEventListener("click", function() {
    document.body.classList.remove("light-mode");
    document.body.classList.remove("blue-mode");
    document.body.classList.add("dark-mode");
    localStorage.setItem("theme", "dark");

});

document.getElementById("blueThemeOption").addEventListener("click", function() {
    document.body.classList.remove("light-mode");
    document.body.classList.remove("dark-mode");
    document.body.classList.add("blue-mode");
    localStorage.setItem("theme", "blue");

});

document.getElementById("themeMenuButton").addEventListener("click", closeThemeMenu);

window.onload = function() {
    var savedTheme = localStorage.getItem("theme");

    if (savedTheme === "light") {
        document.body.classList.remove("dark-mode");
        document.body.classList.add("light-mode");
    }

    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");
        document.body.classList.remove("light-mode");
    }
    if (savedTheme === "blue") {
        document.body.classList.remove("dark-mode");
        document.body.classList.remove("light-mode");
        document.body.classList.add("blue-mode");
    }
};

document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll(".dropdown");
    
    dropdowns.forEach(function(dropdown) {
        var dropbtn = dropdown.querySelector(".dropbtn");
        var dropdownContent = dropdown.querySelector(".dropdown-content");
        
        dropbtn.addEventListener("click", function() {
            dropdownContent.classList.toggle("show");
        });
    });
    
    window.addEventListener("click", function(event) {
        dropdowns.forEach(function(dropdown) {
            if (!dropdown.contains(event.target)) {
                dropdown.querySelector(".dropdown-content").classList.remove("show");
            }
        });
    });
});



/*
let posts = [];


function renderPosts() {
    const postFeed = document.getElementById("postFeed");
    postFeed.innerHTML = "";
    posts.forEach(post => {
        const postElement = document.createElement("div");
        postElement.classList.add("post");
        postElement.innerHTML = `
            <p>${post.message}</p>
            <button class="likeButton" data-id="${post.id}">Curtir (${post.likes})</button>
        `;
        postFeed.appendChild(postElement);
    });


    document.querySelectorAll(".likeButton").forEach(button => {
        button.addEventListener("click", () => {
            const postId = button.getAttribute("data-id");
            likePost(postId);
        });
    });
}


function addPost(message) {
    const newPost = {
        id: Date.now(),
        message: message,
        likes: 0
    };
    posts.unshift(newPost);
    renderPosts();
}


function likePost(postId) {
    const postIndex = posts.findIndex(post => post.id === parseInt(postId));
    if (postIndex !== -1) {
        posts[postIndex].likes++;
        renderPosts();
    }
}

document.getElementById("postButton").addEventListener("click", () => {
    const postText = document.getElementById("postText").value.trim();
    if (postText !== "") {
        addPost(postText);
        document.getElementById("postText").value = "";
    }
});
*/
