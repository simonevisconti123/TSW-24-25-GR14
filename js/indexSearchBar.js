document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".upBar .searchBar input");

    searchInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const posts = document.querySelectorAll(".post");

            posts.forEach(post => {
                const postText = post.querySelector(".postBodyBox")?.textContent.toLowerCase() || "";
                const postTags = post.querySelector(".postTagsBox")?.textContent.toLowerCase() || "";

                if (postText.includes(searchTerm) || postTags.includes(searchTerm)) {
                    post.style.display = "block";
                } else {
                    post.style.display = "none";
                }
            });
        }
    });
});
