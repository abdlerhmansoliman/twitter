<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
const props = defineProps({
    user:Object
})
const form = useForm({
    name: props.user.name,
    email: props.user.email,
    bio: props.user.bio || '',
    link: props.user.link || '',
    current_password: '',   
    password: '',            
    password_confirmation: '',    
    profile_image: null,     
    cover_image: null,
    _method: 'PUT' // Add method spoofing for PUT request
});
console.log(form.name);
const handleFileChange = (field, event) => {
    form[field] = event.target.files[0];
};
const submit = () => {
    form.post(route('profile.update'), {
        forceFormData: true,
        onSuccess: () => {
            console.log('Profile updated successfully');
        },
        onError: (errors) => {
            console.error('Form errors:', errors);
        }
    });
};

</script>

<template>
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-6 p-6 rounded-lg shadow-md">
      <!-- Name -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input
          id="name"
          type="text"
          v-model="form.name"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
          autofocus
          required
        />
        <span v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</span>
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input
          id="email"
          type="email"
          v-model="form.email"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
          required
        />
        <span v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</span>
      </div>

      <!-- Bio -->
      <div>
        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
        <input
          id="bio"
          type="text"
          v-model="form.bio"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
        />
        <span v-if="form.errors.bio" class="text-red-600 text-sm mt-1">{{ form.errors.bio }}</span>
      </div>

      <!-- Password -->
      <div>
        <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
        <input
          id="current_password"
          type="password"
          v-model="form.current_password"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
          autocomplete="current-password"
        />
        <span v-if="form.errors.current_password" class="text-red-600 text-sm mt-1">{{ form.errors.current_password }}</span>
      </div>

      <!-- New Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
        <input
          id="password"
          type="password"
          v-model="form.password"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
          autocomplete="new-password"
        />
        <span v-if="form.errors.password" class="text-red-600 text-sm mt-1">{{ form.errors.password }}</span>
      </div>

      <!-- Confirm New Password -->
      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
        <input
          id="password_confirmation"
          type="password"
          v-model="form.password_confirmation"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
          autocomplete="new-password"
        />
        <span v-if="form.errors.password_confirmation" class="text-red-600 text-sm mt-1">{{ form.errors.password_confirmation }}</span>
      </div>

      <!-- Personal Link -->
      <div>
        <label for="link" class="block text-sm font-medium text-gray-700">Personal Link</label>
        <input
          id="link"
          type="text"
          v-model="form.link"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
        />
        <span v-if="form.errors.link" class="text-red-600 text-sm mt-1">{{ form.errors.link }}</span>
      </div>

      <!-- Profile Image -->
      <div>
        <label for="profile_image" class="block text-sm font-medium text-gray-700">Profile Image</label>
        <input
          id="profile_image"
          type="file"
          @change="handleFileChange('profile_image', $event)"
          class="mt-1 block w-full text-sm text-gray-700"
        />
        <span v-if="form.errors.profile_image" class="text-red-600 text-sm mt-1">{{ form.errors.profile_image }}</span>
      </div>

      <!-- Cover Image -->
      <div>
        <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Image</label>
        <input
          id="cover_image"
          type="file"
          @change="handleFileChange('cover_image', $event)"
          class="mt-1 block w-full text-sm text-gray-700"
        />
        <span v-if="form.errors.cover_image" class="text-red-600 text-sm mt-1">{{ form.errors.cover_image }}</span>
      </div>

      <!-- Submit -->
      <div>
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200"
          :disabled="form.processing"
        >
          {{ form.processing ? 'Saving...' : 'Save Changes' }}
        </button>
      </div>
    </form>
  </div>

</template>