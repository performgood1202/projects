import {
    UPLOAD_CONTENT_PERCENTAGE
} from '../constants/type';

import CustomHook from './customHooks'

export const processUploading = (progress) => {
    const orderHook = CustomHook();
    orderHook.changeOrderCount(UPLOAD_CONTENT_PERCENTAGE, progress)
}