import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function usePhotos() {
    const photos = ref([])

    const getPhotos = async () => {
        let response = await axios.get('/api/photo')
        photos.value = response.data.posts
        photos.value.forEach(i => {
            i.image='storage/'+i.image;
        });
    }

    const newPhoto = async () => {
        let response = await axios.post(`/api/photo`)

    }

    return {
        photos,
        getPhotos
    }
}