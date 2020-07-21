import { NextPage } from 'next'
import FirebaseAuth from '@/components/admin/organisms/firebase/FirebaseAuth'
import Head from 'next/head'

const Signin: NextPage = () => {
  return (
    <div>
      <Head>
        <title>Admin Signin Page</title>
      </Head>

      <h1>Admin Signin Page</h1>

      <FirebaseAuth />
    </div>
  )
}

export default Signin