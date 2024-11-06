import "./bootstrap.js";
import "./styles/app.css";

const newsletterSubmitButton = document.getElementById(
  "newsletterSubmitButton"
);

if (newsletterSubmitButton) {
  newsletterSubmitButton.addEventListener("click", async (event) => {
    event.preventDefault();

    const emailInput = document.getElementById("newsletter");
    const email = emailInput.value;

    try {
      const response = await fetch("/subscribe_newsletter", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email }),
      });

      if (response.ok) {
        const result = await response.json();
        alert(result.message);
      } else {
        alert("Erreur lors de l'inscription. Veuillez réessayer.");
      }
    } catch (error) {
      console.error("Erreur :", error);
      alert("Une erreur est survenue. Veuillez réessayer plus tard.");
    }
  });
}
