import { NextPage } from 'next'
import FirebaseAuth from '@/components/admin/organisms/firebase/FirebaseAuth'
import Head from 'next/head'
import Layout from '@/components/admin/layout/AdminLayout'

const Signin: NextPage = () => {
  return (
    <Layout>
      <Head>
        <title>Admin Signin Page</title>
      </Head>

      <h1>Admin Signin Page</h1>

      <FirebaseAuth />
    </Layout>
  )
}

export default Signin