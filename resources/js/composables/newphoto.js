import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useNewPhoto() {

    const postPhoto = async () => {
        let response = await axios.post('/api/photo')
    }

    return {
      
    }
}