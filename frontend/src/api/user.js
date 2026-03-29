import request from '@/utils/request'
export const registerApi = (data) => {
  return request({
    url: '/v1/register',
    method: 'post',
    data
  })
}
