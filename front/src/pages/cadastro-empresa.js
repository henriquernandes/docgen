import ApplicationLogo from '@/components/ApplicationLogo'
import AuthCard from '@/components/AuthCard'
import Button from '@/components/Button'
import GuestLayout from '@/components/Layouts/GuestLayout'
import Input from '@/components/Input'
import InputError from '@/components/InputError'
import Label from '@/components/Label'
import Link from 'next/link'
import { useAuth } from '@/hooks/auth'
import { useState } from 'react'

const CadastroEmpresa = () => {
    const { registerCompany } = useAuth({
        middleware: 'guest',
        redirectIfAuthenticated: '/dashboard',
    })

    const [form, setForm] = useState({
        nome: '',
        email: '',
        password: '',
        password_confirmation: '',
        empresa_nome: '',
        empresa_email: '',
        cnpj: '',
    })
    const [errors, setErrors] = useState([])

    const handleChange = event => {
        setForm({...form, [event.target.id]: event.target.value});
    }
    const submitForm = event => {
        event.preventDefault()

        registerCompany({
            ...form,
            setErrors,
        })
    }

    return (
        <GuestLayout>
            <AuthCard
                logo={
                    <Link href="/">
                        <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
                    </Link>
                }>
                <form onSubmit={submitForm}>
                    <h3 className="text-2xl font-semibold pb-4">Cadastro empresa</h3>
                    <div className="grid grid-cols-2 gap-4">
                        {/* Nome */}
                        <div>
                            <Label htmlFor="nome">Nome</Label>

                            <Input
                                id="nome"
                                type="text"
                                value={form.nome}
                                className="block mt-1 w-full"
                                onChange={handleChange}
                                required
                                autoFocus
                            />

                            {/* Email Address */}
                            <div className="mt-4">
                                <Label htmlFor="email">Email</Label>

                                <Input
                                    id="email"
                                    type="email"
                                    value={form.email}
                                    className="block mt-1 w-full"
                                    onChange={handleChange}
                                    required
                                />

                                <InputError messages={errors.email} className="mt-2" />
                            </div>

                            {/* Senha */}
                            <div className="mt-4">
                                <Label htmlFor="password">Senha</Label>

                                <Input
                                    id="password"
                                    type="password"
                                    value={form.password}
                                    className="block mt-1 w-full"
                                    onChange={handleChange}
                                    required
                                    autoComplete="new-password"
                                />

                                <InputError
                                    messages={errors.password}
                                    className="mt-2"
                                />
                            </div>

                            {/* Confirmar Senha */}
                            <div className="mt-4">
                                <Label htmlFor="password_confirmation">
                                    Confirmar Senha
                                </Label>

                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    value={form.password_confirmation}
                                    className="block mt-1 w-full"
                                    onChange={handleChange}
                                    required
                                />

                                <InputError
                                    messages={errors.password_confirmation}
                                    className="mt-2"
                                />
                            </div>
                            <InputError messages={errors.name} className="mt-2" />
                        </div>
                        <div>
                            <Label htmlFor="empresa_nome">Nome da empresa</Label>

                            <Input
                                id="empresa_nome"
                                type="text"
                                value={form.empresa_nome}
                                className="block mt-1 w-full"
                                onChange={handleChange}
                                required
                                autoFocus
                            />

                            {/* Email Address */}
                            <div className="mt-4">
                                <Label htmlFor="empresa_email">Email da empresa</Label>

                                <Input
                                    id="empresa_email"
                                    type="email"
                                    value={form.empresa_email}
                                    className="block mt-1 w-full"
                                    onChange={handleChange}
                                    required
                                />

                                <InputError messages={errors.email} className="mt-2" />
                            </div>

                            {/* CNPJ */}
                            <div className="mt-4">
                                <Label htmlFor="cnpj">CNPJ</Label>

                                <Input
                                    id="cnpj"
                                    type="text"
                                    value={form.cnpj}
                                    className="block mt-1 w-full"
                                    onChange={handleChange}
                                    required
                                    autoFocus
                                />

                                <InputError
                                    messages={errors.password}
                                    className="mt-2"
                                />
                            </div>
                        </div>
                    </div>


                    <div className="flex items-center justify-end mt-4">
                        <Link
                            href="/login"
                            className="underline text-sm text-gray-600 hover:text-gray-900">
                            Já cadastrado?
                        </Link>

                        <Button className="ml-4">Cadastrar empresa</Button>
                    </div>
                </form>
            </AuthCard>
        </GuestLayout>
    )
}

export default CadastroEmpresa
