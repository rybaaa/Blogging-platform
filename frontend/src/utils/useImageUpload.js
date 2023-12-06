import { ref, watch } from "vue";
import { articlesStore } from "@/stores/articles";

export function useImageUpload() {
  let imageFile = ref("");
  let imageUrl = ref("");
  const articles = articlesStore()

  function handleImageSelected(event) {
    if (event.target.files.length === 0) {
      imageFile.value = "";
      imageUrl.value = "";
      return;
    }

    imageFile.value = event.target.files[0];
  }

  watch(imageFile, (imageFile) => {
    if (!(imageFile instanceof File)) {
      return;
    }

    let fileReader = new FileReader();

    fileReader.readAsDataURL(imageFile);

    fileReader.addEventListener("load", () => {
      imageUrl.value = fileReader.result;
      articles.uploadedImage = imageUrl.value
    });
    console.log(imageUrl);
  });

  return {
    imageFile,
    imageUrl,
    handleImageSelected,
  };
}